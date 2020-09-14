<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = [];
        $values = [];
        for ($i=6;$i>=0;$i--){
            $date = date('Y/m/d',strtotime("-".$i." days"));
            $day = substr($date,8,2);
            array_push($dates,$date);
            $booking_amount = Booking::whereDay('created_at',$day)->sum('total_amount');
            array_push($values,$booking_amount);
        }
        $currentMonth = date('m');

        $active_bookings = Booking::where('status','!=','Checked-Out')->count();
        $rooms_available = Room::all()->count() - $active_bookings;
        $month_bookings = Booking::whereRaw('MONTH(created_at) = ?',[$currentMonth])->count();
        $today_earnings = Booking::whereDay('created_at', now()->day)->sum('total_amount');
        $month_earnings = Booking::whereRaw('MONTH(created_at) = ?',[$currentMonth])->sum('total_amount');

        return view('home',[
            'active_bookings'=>$active_bookings,
            'rooms_available'=>$rooms_available,
            'month_bookings'=>$month_bookings,
            'today_earnings'=>$today_earnings,
            'month_earnings'=>$month_earnings,
            'dates'=>json_encode($dates),
            'values'=>json_encode($values)
        ]);
    }
}
