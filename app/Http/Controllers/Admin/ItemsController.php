<?php

namespace App\Http\Controllers\Admin;

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
        return redirect(route('admin.bookings.show',[$request->booking_id]));
    }
}
