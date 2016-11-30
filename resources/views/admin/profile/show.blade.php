<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 11/29/16
 * Time: 2:27 PM
 */
?>

@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row">
			<div class="x_panel">
				<div class="x_content">
					{{-- Login User Summery --}}
					<div class="col-sm-8 col-xs-12 pull-right user-short-dashboard">
						<h2>Hello</h2>
						<div class="row">
							<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-caret-square-o-right"></i>
									</div>
									<div class="count">179</div>
									<h3>New Sign ups</h3>
								</div>
							</div>
						</div>
						{{-- Profile Bio --}}
						<div>{!! $id->bio !!}</div>
					</div>
					{{-- Login User Profile Info --}}
					<aside class=" col-sm-4 col-xs-12 profile-in-sidebar">
						@if(!empty($id->avatar))
							<img src="{!! $id->avatar !!}" alt="{!! $id->user->name !!}" class="imgresponsive img-thumbnail">
						@endif
						<h2>{!! $id->user->name !!}</h2>
						<p><strong>{!! $id->user->email !!}</strong></p>
						<p><strong>{!! $id->company !!}</strong></p>
						<p>{!! $id->designation !!}</p>
						<p>{!! $id->address !!}</p>
						<p>{!! $id->country !!}</p>
						<p>{!! $id->phone !!}</p>
						<p>{!! $id->web !!}</p>
					</aside>
				</div>
			</div>
		</div>
	</div>
@endsection