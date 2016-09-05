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
                    Edit Region
                </div>
                <div class="x_content">
                    {!! Form::model($id,['action'=>['RegionController@update',$id->slug], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                    @include('admin.region._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
