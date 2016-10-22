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
                    Edit Invoice
                    <a class="btn btn-primary pull-right" href="{!! action('InvoiceController@show',$id->id) !!}">Preview</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::model($id,['action'=>['InvoiceController@update',$id->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                    @include('admin.invoice._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
