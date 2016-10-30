<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/31/16
 * Time: 12:47 AM
 */?>
@extends('layouts.admin')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_title">
					<h3>{!! $meta['title'] !!}</h3>
				</div>
				<div class="x_content">
					@php $rows? $start = ($rows->currentPage()*$rows->perPage())-$rows->perPage(): $start =0 @endphp
					<table class="table table-bordered" id="rows">
						<thead>
						<tr>
							<th>#</th>
							@foreach($meta['fields'] as $field)
								<th>{!! $field['label'] !!}</th>
							@endforeach
						</tr>
						</thead>
						<tbody>
						@foreach($rows as $sl=>$row)
							<tr>
								<td>{!! $start + ++$sl !!}</td>
								@foreach($meta['fields'] as $field)
									<td>{!! $row->{$field['name']} !!}</td>
								@endforeach
							</tr>
						@endforeach
						</tbody>
					</table>
					@unless($rows)
						<h2>No Data</h2>
					@endunless
				</div>
			</div>
		</div>
	</div>

@endsection
