<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Booking;

class FindRoomsController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::all();
        $rooms = Room::all();
//        $rm = Room::select('rooms.id');
//        dd($rm);

        if (!Gate::allows('find_room_access')) {
            return abort(401);
        }
        $time_from = $request->input('time_from');
        $time_to = $request->input('time_to');

        if ($request->isMethod('POST')) {
//            $allRooms = Booking::where('booking')
        } else {
            $allRooms = null;
        }
        return view('admin.find_rooms.index', compact(
            'allRooms',
                  'time_from',
                     'time_to',
                     'bookings',
                     'rooms'));
    }
}
