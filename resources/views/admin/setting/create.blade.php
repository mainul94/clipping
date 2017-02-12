<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 2/12/17
 * Time: 7:57 PM
 */?>
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="x_panel">
                <div class="x_title">
                    Create Setting
                </div>
                <div class="x_content">
                    {!! Form::open(['action'=>'SettingController@store', 'class'=>'form-horizontal']) !!}
                    <div class="col-xs-12 form-group {!! $errors->has('name')? 'has-error':'' !!}">
                        {!! Form::label('name', "Name", ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 form-group {!! $errors->has('options')? 'has-error':'' !!}">
                        {!! Form::label('options', "Options", ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('options', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        {!! Form::submit('Save', ['class'=> 'btn btn-info pull-right']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

