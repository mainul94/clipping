<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 2/12/17
 * Time: 12:53 AM
 */
?>
@extends('layouts.admin')

@push('title') Setting @endpush

@section('content')
    <div class="row">
        @foreach($rows as $setting)
            <div class="col-sm-12 col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        {!! title_case($setting->name) !!}
                    </div>
                    <div class="x_content">
                        {!! Form::model($setting, ['action'=> ['SettingController@update', $setting->id], 'method' => 'PATCH']) !!}
                        <div class="col-xs-12 form-group {!! $errors->has('name')? 'has-error':'' !!}">
                            {!! Form::label('name', "Name", ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                    {!! Form::text('name', null, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        @if($setting->options)
                            @foreach($setting->options as $key=>$opt)
                                <div class="col-xs-12 form-group {!! $errors->has('options['.$key.']')? 'has-error':'' !!}">
                                    {!! Form::label('options['.$key.']', title_case($key), ['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        @if(in_array($opt, ['message', 'content', 'summery', 'details']))
                                            {!! Form::textarea('options['.$key.']', null, ['class'=>'form-control']) !!}
                                        @else
                                            {!! Form::text('options['.$key.']', null, ['class'=>'form-control']) !!}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            {{--ToDo Need to add custom kdey and value to optons--}}
                            <div class="col-xs-12">
                                {!! Form::submit('Save', ['class'=> 'btn btn-info pull-right']) !!}
                            </div>
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection