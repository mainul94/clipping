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
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    Edit Category
                </div>
                <div class="x_content">
                    {!! Form::model($id,['action'=>['CategoryController@update',$id->slug], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                    @include('admin.category._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
