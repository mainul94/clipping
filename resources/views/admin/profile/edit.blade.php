<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:32 PM
 */
?>
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="x_panel">
                <div class="x_title">
                    Update your Profile
                </div>
                <div class="x_content">
                    {!! Form::model($id,['action'=>['ProfileController@update',$id->id], 'method'=>'PATCH',
                    'class'=>'form-horizontal', 'files'=>true]) !!}
                    @include('admin.profile._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
