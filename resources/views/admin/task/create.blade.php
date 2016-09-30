<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/8/16
 * Time: 1:00 AM
 */

        ?>
@extends('layouts.admin')

@push('title') Task Create @endpush

{{--@section('content-header')
    @include('_partial.breadcrumb',['breadcrumb_title'=>'Task Create'])
@endsection--}}
@section('content')
<div class="content">
    <div class="x_panel">
        {!! Form::open(array('url' => action('TaskController@store'),'class'=>'form-horizontal')) !!}
        @include('admin.task._task')
        {!! Form::close() !!}
    </div>
</div>
@endsection