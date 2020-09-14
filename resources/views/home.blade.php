@extends('layouts.app')

@section('content')
    <style>
        .dashboard-icon{
            float:right;
            margin-right: 25px;
        }
        .stat{
            margin-left: 30px;
            font-size: 55px;
            width: max-content;
        }
        .earnings{
            margin-left: 30px;
            padding-top:18px;
            font-size: 25px;
            width: max-content;
        }
        .con{
            margin-top:2px;
            margin-bottom: 2px;
        }
    </style>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <div id="app">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Active Bookings</div>
                <div class="panel-body">
                    <div class="con">
                        <img class="dashboard-icon" src="{{ asset('images/room.png') }}">
                        <p class="stat">{{$active_bookings}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Rooms Available</div>
                <div class="panel-body">
                    <div class="con">
                        <img class="dashboard-icon"  src="{{ asset('images/room2.png') }}">
                            <p class="stat">{{$rooms_available}}</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Bookings this month</div>
                <div class="panel-body">
                    <div class="con">
                        <img class="dashboard-icon"  src="{{ asset('images/bed.png') }}">
                            <p class="stat">{{$month_bookings}}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Earnings today</div>
                    <div class="panel-body">
                        <div class="con">
                            <img class="dashboard-icon"  src="{{ asset('images/money.png') }}">
                            <p class="earnings">{{$today_earnings}} ₹</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Earnings this month</div>
                    <div class="panel-body">
                        <div class="con">
                            <img class="dashboard-icon"  src="{{ asset('images/money2.png') }}">
                            <p class="earnings">{{$month_earnings}} ₹</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <booking-chart width="1000" height="490"
                           id="chart2"
                           type="line"
                           title="Bookings Revenue this week"
                           :labels='{{ $dates }}'
                           :data='{{ $values }}'
                           :border-color="'rgba(153, 102, 255, 1)'"
                           border-width="2"
                           fill="false"></booking-chart>
        </div>
    </div>
    </div>
@endsection
