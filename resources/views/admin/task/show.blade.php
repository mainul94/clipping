<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/27/16
 * Time: 9:11 PM
 */?>
@extends('layouts.admin')
@section('content')
	<div class="content">
		<div class="x_panel">
			<!-- Upload Images Modal -->
			<div class="x_header">
				View Task - {!! Html::taskStatusLabel($id->status) !!}
				@permission("update.task")
				<a class="btn btn-primary pull-right" href="{!! action('TaskController@edit',$id->id) !!}">Edit</a>
				@endpermission
			</div>

			<h4 class="col-xs-12">JOB ID: {!! $id->id !!}</h4>
			<div class="row">
				@include('admin.task._task_show')
			</div>
			<div class="row">
				@include('media._content')
			</div>
			{{--@if(array_key_exists('images', $withData) && count($withData['images'])>0)
				<h3>Images</h3>
				@include('admin.task._image_view')
			@endif--}}
			<div class="clearfix"></div>
			@include('admin.comment.comment',['row'=>$id])
			<div class="clearfix"></div>
		</div>
	</div>
@endsection
