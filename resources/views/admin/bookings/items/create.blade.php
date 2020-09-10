@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Add Items')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.items.create']]) !!}
@csrf
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Store')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.categories.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('Description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('amount', trans('Amount').'', ['class' => 'control-label']) !!}
                    {!! Form::number('amount', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('quantity', trans('Quantity').'', ['class' => 'control-label']) !!}
                    {!! Form::number('quantity', old('quantity'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('quantity'))
                        <p class="help-block">
                            {{ $errors->first('quantity') }}
                        </p>
                    @endif
                </div>

                <input type="hidden" value="{{$id}}" name="booking_id">

                <div class="col-xs-12 form-group">
                    {!! Form::label('total_amount', trans('Total Amount').'', ['class' => 'control-label']) !!}
                    {!! Form::number('total_amount', old('total_amount'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total_amount'))
                        <p class="help-block">
                            {{ $errors->first('total_amount') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection