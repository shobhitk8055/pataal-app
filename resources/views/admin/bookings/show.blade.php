@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <div id="app">

    <h3 class="page-title">@lang('quickadmin.bookings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>
        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.customer')</th>
                            <td field-key='customer'>{{ $booking->customer->first_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.room')</th>
                            <td field-key='room'>{{ $booking->room->room_number ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.time-from')</th>
                            <td field-key='time_from'>{{ $booking->time_from }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.time-to')</th>
                            <td field-key='time_to'>{{ $booking->time_to }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.additional-information')</th>
                            <td field-key='additional_information'>{!! $booking->additional_information !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('Booking Status')</th>
                            <td field-key='additional_information'>{!! $booking->status !!}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3 offset-2">
                    <payment book='@json($booking)'
                             csrf="{{csrf_token()}}"
                    ></payment>
                </div>
            </div>

            <p>Billing Details</p>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Room Booking - From {{$booking->time_from}} to {{ $booking->time_to }}</td>
                    <td>{{ $booking->amount }} ₹</td>
                    <td>1</td>
                    <td>{{ $booking->amount }} ₹</td>
                    <td></td>
                </tr>
                @foreach($items as $item)
                <tr>
                    <th scope="row">{{$count++}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->amount}} ₹</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->total_amount}} ₹</td>
                    <td>
                        <a class="text-danger" href="{{route('admin.items.delete',[$item->id])}}">delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <td class="mt-3"></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td>{{$booking->amount + $booking->items_total ?? 0}} ₹</td>
                </tr>
                <tr>
                    <th></th>
                    <td class="mt-3"></td>
                    <td></td>
                    <td>Discount</td>
                    <td>{{$booking->discount ?? 0}} ₹</td>
                </tr>
                <tr>
                    <th></th>
                    <td class="mt-3"></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>{{$booking->total_amount}} ₹</b></td>
                </tr>
                </tbody>
            </table>
            <br>
            <div class="container">
                    <discount sum="{{$booking->total_amount}}"
                              csrf="{{csrf_token()}}"
                              book="{{$booking->id}}"
                    ></discount>
                <br>
            </div>
            <a href="{{route('admin.items.store',[$booking->id])}}" class="btn btn-primary">@lang('Add Item')</a>
            <a href="{{route('admin.items.pdf',[$booking->id])}}" class="btn btn-default">@lang('Generate pdf')</a>
            <a href="{{route('admin.bookings.index')}}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
    </div>

@stop
