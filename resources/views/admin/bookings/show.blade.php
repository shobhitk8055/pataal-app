@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/app.js') }}" defer></script>

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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Room Booking - From {{$booking->time_from}} to {{ $booking->time_to }}</td>
                    <td>{{ $booking->amount }} ₹</td>
                    <td>1</td>
                    <td>{{ $booking->amount }} ₹</td>
                </tr>
                @foreach($items as $item)
                <tr>
                    <th scope="row">{{$count++}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->amount}} ₹</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->total_amount}} ₹</td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <td class="mt-3">Discount</td>
                    <td></td>
                    <td></td>
                    <td><b>0 ₹</b></td>
                </tr>
                <tr>
                    <th></th>
                    <td class="mt-3"><b>Total</b></td>
                    <td></td>
                    <td></td>
                    <td><b>{{$total}} ₹</b></td>
                </tr>
                </tbody>
            </table>
            <br>
            <div class="container">
                <div id="app">
                    <discount></discount>
                </div>
                <br>
            </div>

            <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">@lang('Add Item')</a>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
