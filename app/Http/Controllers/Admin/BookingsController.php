<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Customer;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBookingsRequest;
use App\Http\Requests\Admin\UpdateBookingsRequest;
use Carbon\Carbon;

class BookingsController extends Controller
{
    /**
     * Display a listing of Booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('booking_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (!Gate::allows('booking_delete')) {
                return abort(401);
            }
            $bookings = Booking::onlyTrashed()->get();
        } else {
            $bookings = Booking::all();
        }

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating new Booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('booking_create')) {
            return abort(401);
        }

        $customers = Customer::get()->pluck('full_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $rooms = Room::get()->where('status','available')
                            ->pluck('room_number', 'id','status')
                            ->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.bookings.create', compact('customers', 'rooms'));
    }

    /**
     * Store a newly created Booking in storage.
     *
     * @param  \App\Http\Requests\StoreBookingsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingsRequest $request)
    {
        $myTime = new Carbon();
        if (!Gate::allows('booking_create')) {
            return abort(401);
        }

        $booking = Booking::create($request->all());

        if ($booking->status==="Checked-In"){
            $booking->update([
                'check_in_time'=>$myTime->toDateTimeString()
            ]);
        }
        $booking->update([
           'total_amount'=>$booking->amount,
           'payment_status'=>0
        ]);

        $room = Room::find($booking->room_id);
        switch ($booking->status){
            case "Booked":
                $room->update([
                    'status'=> 'Booked'
                ]);
                break;
            case "Confirmed":
            case "Checked-In":
                $room->update([
                    'status'=> 'unavailable'
                ]);
                break;
        }

        return redirect()->route('admin.bookings.index');
    }

    public function checkout(Request $request){

        $myTime = new Carbon();
        $id = $request->bookingId;

        $status= $request->status;

        $booking = Booking::find($id);
        $booking->update([
            'status'=> $status,
            'check_out_time'=> $myTime->toDateTimeString()
        ]);

        Room::find($booking->room_id)->update([
            'status'=>"available"
        ]);

        return redirect()->route('admin.bookings.index');
    }


    /**
     * Show the form for editing Booking.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('booking_edit')) {
            return abort(401);
        }

        $customers = Customer::get()->pluck('first_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $rooms = Room::get()->pluck('room_number', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $booking = Booking::findOrFail($id);

        return view('admin.bookings.edit', compact('booking', 'customers', 'rooms'));
    }

    /**
     * Update Booking in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingsRequest $request, $id)
    {
        if (!Gate::allows('booking_edit')) {
            return abort(401);
        }

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        $room = Room::find($booking->room_id);
        switch ($booking->status){
            case "Booked":
                $room->update([
                    'status'=> 'Booked'
                ]);
                break;
            case "Confirmed":
            case "Checked-In":
                $room->update([
                    'status'=> 'unavailable'
                ]);
                break;
        }

        return redirect()->route('admin.bookings.index');
    }


    /**
     * Display Booking.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('booking_view')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);
        $items = DB::table('booking_items')->where('booking_id',$booking->id)->get();
        $count = 2;
        return view('admin.bookings.show', compact('booking','items','count'));
    }


    /**
     * Remove Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index');
    }

    public function discount(Request $request){
        $booking = Booking::find($request->bookingId);
        $booking->update([
           'discount'=>$request->discount,
            'total_amount'=> $booking->amount + $booking->items_total - $request->discount
        ]);
        return redirect()->route('admin.bookings.show',[$booking->id]);
    }

    public function payment(Request $request){
        $myTime = new Carbon();

        $booking = Booking::find($request->bookingId);
        $booking->update([
            'payment_status'=>1,
            'mode'=>$request->mode,
            'time'=>$myTime->toDateTimeString()
        ]);
        switch ($booking->mode){
            case 'credit':
            case 'debit':
                $booking->update([
                   'card_no'=>$request->card_no
                ]);
                break;
            case 'google_pay':
            case 'phone_pay':
            case 'upi':
                $booking->update([
                    'upi_id'=>$request->upi_id
                ]);
                break;
            case 'paytm':
                $booking->update([
                    'paytm_no'=>$request->paytm_no
                ]);
                break;
        }
        return redirect(route('admin.bookings.show',[$booking->id]));
    }

    /**
     * Delete all selected Booking at once.
     *
     * @param Request $request
     */

    public function massDestroy(Request $request)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Booking::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->restore();

        return redirect()->route('admin.bookings.index');
    }

    /**
     * Permanently delete Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->forceDelete();

        return redirect()->route('admin.bookings.index');
    }
}
