<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:27 PM
 */
?>

@extends('layouts.admin')
@section('content')
	<div class="row padding-vertical-p5em">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>View Trail </h2>
					<a class="btn btn-primary pull-right" href="{!! action('TrailController@edit',$id->id) !!}">Edit</a>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Name</strong>
						<div class="col-sm-8">
							{!! $id->name !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Email</strong>
						<div class="col-sm-8">
							{!! $id->email !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Phone</strong>
						<div class="col-sm-8">
							{!! $id->phone !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Company</strong>
						<div class="col-sm-8">
							{!! $id->company !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Title</strong>
						<div class="col-sm-8">
							{!! $id->title !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Instruction</strong>
						<div class="col-sm-8">
							{!! $id->instruction !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Quantity</strong>
						<div class="col-sm-8">
							{!! $id->quantity !!}
						</div>
					</div>

					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Sample Image</strong>
						<div class="col-sm-8">
							@if(!empty($id) && !empty($id->sample_one))
								<div class="col-sm-4 quotation-thumbnail-wrapper">
									<img class="img-responsive img-thumbnail" src="{!! asset($id->sample_one) !!}" alt="">
								</div>
							@endif
							@if(!empty($id) && !empty($id->sample_two))
								<div class="col-sm-4 quotation-thumbnail-wrapper">
									<img class="img-responsive img-thumbnail" src="{!! asset($id->sample_two) !!}" alt="">
								</div>
							@endif
							@if(!empty($id) && !empty($id->sample_three))
								<div class="col-sm-4 quotation-thumbnail-wrapper">
									<img class="img-responsive img-thumbnail" src="{!! asset($id->sample_three) !!}" alt="">
								</div>
							@endif
							@if(!empty($id) && !empty($id->sample_four))
								<div class="col-sm-4 quotation-thumbnail-wrapper">
									<img class="img-responsive img-thumbnail" src="{!! asset($id->sample_four) !!}" alt="">
								</div>
							@endif
							@if(!empty($id) && !empty($id->sample_five))
								<div class="col-sm-4 quotation-thumbnail-wrapper">
									<img class="img-responsive img-thumbnail" src="{!! asset($id->sample_five) !!}" alt="">
								</div>
							@endif
						</div>
					</div>


					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Comment</strong>
						<div class="col-sm-8">
							{!! $id->comment !!}
						</div>
					</div>


					<div class="row padding-vertical-p5em">
						<strong class="col-sm-3">Status</strong>
						<div class="col-sm-8">
							{!! $id->status !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection