<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function store($id){
        return view('admin.bookings.items.create',[
            'id'=>$id
        ]);
    }

    public function create(Request $request){
        DB::table('booking_items')->insert([
            'name'=>$request->name,
            'description'=>$request->description,
            'amount'=>$request->amount,
            'quantity'=>$request->quantity,
            'total_amount'=>$request->total_amount,
            'booking_id'=>$request->booking_id
        ]);
        $all_items_total = DB::table('booking_items')
                            ->where('booking_id',$request->booking_id)
                            ->sum('total_amount');
        Booking::find($request->booking_id)->update([
            'items_total'=>$all_items_total,
        ]);

        return redirect(route('admin.bookings.show',[$request->booking_id]));
    }

    public function delete($id){

        $bookID = DB::table('booking_items')->find($id)->booking_id;
        DB::delete('delete from booking_items where id = ?',[$id]);

        return redirect()->route('admin.bookings.show',[$bookID]);
    }
}
