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
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    Create Category
                </div>
                <div class="x_content">
                    {!! Form::open(['action'=>'CategoryController@store', 'class'=>'form-horizontal']) !!}
                    <div class="row">
                        @include('admin.category._form')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
