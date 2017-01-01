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
            <div class="clearfix"></div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" class="center-block" data-toggle="collapse" data-parent="#accordion" href="#details" aria-expanded="true" aria-controls="details">
                                Details <i class="fa fa-eye-slash pull-right" aria-hidden="true"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="details" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            @include('admin.task._task')
                        </div>
                    </div>
                </div>
            </div>
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