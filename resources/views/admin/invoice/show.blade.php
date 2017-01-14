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
	<div class="row">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_title hidden-print">
					<h2>Invoice View </h2>
					@permission("update.invoice")
					<a class="btn btn-primary pull-right" href="{!! action('InvoiceController@edit',$id->id) !!}">Edit</a>
					@endpermission
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<section class="content invoice">
						<!-- title row -->
						<div class="row">
							<div class="col-xs-12 invoice-header">
								<h1>
									<i class="fa fa-globe"></i> Invoice.
									<small class="pull-right">@if(isset($id->invoice_date))Date: {!! $id->invoice_date->format('d-M-Y') !!} @endif</small>
								</h1>
							</div>
							<!-- /.col -->
						</div>
						<!-- info row -->
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								From
								<address>
									<strong>Clipping Path Associate</strong>
									{!! $id->from_address !!}
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 invoice-col">
								To
								<address>
									<strong>{!! $id->client->name !!}</strong>
									{!! $id->to_address !!}
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 invoice-col">
								<b>Invoice #{!! $id->id !!}</b>
								<br>
								<br>
								<b>Payment Due:</b> <i class="fa fa-{{ strtolower($id->currency) }}"></i>{!! $id->totals - $id->paid_amount !!}
								<br>
								@if(isset($id->account))<b>Account:</b> {!! $id->account !!} @endif
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<!-- Table row -->
						<div class="row">
							<div class="col-xs-12 table">
								<table class="table table-striped table-bordered">
									<thead>
									<tr>
										<th>SL</th>
										<th>Date</th>
										<th>Task ID</th>
										<th>Task</th>
										<th>Qty</th>
										<th>Subtotal</th>
									</tr>
									</thead>
									<tbody>
									@foreach($id->children as $sl=>$child)
										<tr>
											<td>{!! ++$sl !!}</td>
											<td>{!! $child->task->created_at->format('d-M-Y') !!}</td>
											<td>{!! $child->task_id !!}</td>
											<td>{!! $child->task->title !!}</td>
											<td>{!! $child->qty !!} {!! $child->uom !!}</td>
											<td><i class="fa fa-{{ strtolower($id->currency) }}"></i>{!! $child->amount !!}</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<div class="row">
							<!-- accepted payments column -->
							<div class="col-xs-6">
								{{--<p class="lead">Payment Methods:</p>
								<img src="{!! asset('images/visa.png') !!}" alt="Visa">
								<img src="{!! asset('images/mastercard.png') !!}" alt="Mastercard">
								<img src="{!! asset('images/american-express.png') !!}" alt="American Express">
								<img src="{!! asset('images/paypal.png') !!}" alt="Paypal">
								<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
									Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
								</p>--}}
							</div>
							<!-- /.col -->
							<div class="col-xs-6">
								<p class="lead">@if(isset($id->invoice_date))Amount Due {!! $id->invoice_date->format('d-M-Y') !!} @endif </p>
								<div class="table-responsive">
									<table class="table">
										<tbody>
										<tr>
											<th style="width:50%">Subtotal:</th>
											<td><i class="fa fa-{{ strtolower($id->currency) }}"></i>{!! $id->subtotal !!}</td>
										</tr>
										<tr>
											<th>Tax </th>
											<td><i class="fa fa-{{ strtolower($id->currency) }}"></i>{!! $id->tax !!}</td>
										</tr>
										<tr>
											<th>Total:</th>
											<td><i class="fa fa-{{ strtolower($id->currency) }}"></i>{!! $id->totals !!}</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<!-- this row will not appear when printing -->
						<div class="row no-print">
							<div class="col-xs-12">
								<button class="btn btn-default hidden-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
								<button class="btn btn-success pull-right hidden-print"><i class="fa fa-credit-card"></i> Submit Payment</button>
								{{--<button class="btn btn-primary pull-right hidden-print" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>--}}
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
@endsection