@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<div id="app">

<calendar style="width:600px" booking="{{ $bookings }}" room="{{$rooms}}"></calendar>
</div>
    @stop