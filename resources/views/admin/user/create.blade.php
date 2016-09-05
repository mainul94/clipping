<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:27 PM
 */
?>
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="x_panel">
                <div class="x_title">
                    Create User
                </div>
                <div class="x_content">
                    {!! Form::open(['action'=>'UserController@store', 'class'=>'form-horizontal']) !!}
                    @include('admin.user._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
