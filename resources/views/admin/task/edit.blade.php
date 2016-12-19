<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/8/16
 * Time: 1:00 AM
 */

        ?>
@extends('layouts.admin')

@push('title') Task Edit @endpush
{{--@section('content-header')--}}
    {{--@include('_partial.breadcrumb',['breadcrumb_title'=>'Task Edit'])--}}
{{--@endsection--}}
@section('content')
<div class="content">
    <div class="x_panel">
        {!! Form::model($id,['action'=>['TaskController@update',$id->id], 'method'=>'PATCH','class'=>'form-horizontal', /*'files' => true*/]) !!}
        <h4 class="col-xs-12">JOB ID: {!! $id->id !!}</h4>
        @include('admin.task._task')
        {!! Form::close() !!}
        <div class="row">
            @include('media._content')
        </div>
        {{--@if(array_key_exists('images', $withData) && count($withData['images'])>0)
            @include('admin.task._image_view')
        @endif--}}
        <div class="clearfix"></div>
        @include('admin.comment.comment',['row'=>$id])
        <div class="clearfix"></div>
    </div>
</div>
@endsection