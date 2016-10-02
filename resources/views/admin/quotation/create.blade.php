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
                    Create Quotation
                </div>
                <div class="x_content">
                    {!! Form::open(['action'=>'QuotationController@store', 'class'=>'form-horizontal', 'files'=>true]) !!}
                    @include('admin.quotation._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
