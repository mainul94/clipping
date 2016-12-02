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
					<div class="col-sm-9 col-xs-12 pull-right user-short-dashboard">
						{{--Task Section--}}
						<div class="divider-dashed"></div>
						<h2>Tasks</h2>
						<div class="row tile_count">
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Total Task</span>
								<div class="count blue">{!! $id->user->tasks->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Pending Tasks</span>
								<div class="count orange">{!! $id->user->tasks()->pending()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Accepted Tasks</span>
								<div class="count green">{!! $id->user->tasks()->accepted()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Rejected Tasks</span>
								<div class="count red">{!! $id->user->tasks()->rejected()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Holding Tasks</span>
								<div class="count orange">{!! $id->user->tasks()->hold()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Processing Tasks</span>
								<div class="count orange">{!! $id->user->tasks()->processing()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Completed Tasks</span>
								<div class="count green">{!! $id->user->tasks()->completed()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Finished Tasks</span>
								<div class="count blue">{!! $id->user->tasks()->finished()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
						</div>
						<div class="divider-dashed"></div>
						{{--End Task Section--}}
						{{--Invoice Section--}}
						<div class="divider-dashed"></div>
						<h2>Invoices</h2>
						<div class="row tile_count">
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Total Invoices</span>
								<div class="count blue">{!! $id->user->tasks->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Unpaid Invoice</span>
								<div class="count orange">{!! $id->user->tasks()->pending()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Paid Invoice</span>
								<div class="count green">{!! $id->user->tasks()->accepted()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Total Invoiced Amount</span>
								<div class="count orange">{!! $id->user->tasks()->hold()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Paid Invoice Amount</span>
								<div class="count orange">{!! $id->user->tasks()->processing()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top">Unpaid Invoice Amount</span>
								<div class="count green">{!! $id->user->tasks()->completed()->count() !!}</div>
								<span class="count_bottom"><i class="green"></i></span>
							</div>
						</div>
						<div class="divider-dashed"></div>
						{{--End Invoice Section--}}
						{{-- Profile Bio --}}
						<div>{!! $id->bio !!}</div>
					</div>
					{{-- Login User Profile Info --}}
					<aside class=" col-sm-3 col-xs-12 profile-in-sidebar">
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