<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:36 PM
 */
?>
@extends('layouts.admin')
@section('title') Invoice list @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Invoice list
                        <small><a class="btn btn-primary pull-right" href="{!! action('InvoiceController@create') !!}">New</a></small>
                    </h3>
                </div>
                <div class="x_content">
                    @php $rows? $start = ($rows->currentPage()*$rows->perPage())-$rows->perPage(): $start =0 @endphp
                    <table class="table table-bordered" id="rows">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Invoice</th>
                            <th>Qty</th>
                            <th>Totals</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $sl=>$row)
                            <tr>
                                <td>{!! $start + ++$sl !!}</td>
                                <td>{!! $row->client->name !!}</td>
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->total_qty !!}</td>
                                <td>{!! $row->totals !!}</td>
                                <td>
                                    @if(!empty($row->due_date) && $row->status == "Unpaid" && $row->due_date->diffInDays() <=0)
                                        {!! $row->due_date->format('d-M-Y') !!}
                                    @else
                                        {!! $row->due_date->format('d-M-Y') !!}
                                    @endif
                                </td>
                                <td>{!! $row->status !!}</td>
                                <td class="text-center action-btn-wrapper">
                                    <a class="text-success" href="{!! action('InvoiceController@show',$row->id) !!}"><i class="fa fa-eye"></i></a>
                                    <a class="text-warning" href="{!! action('InvoiceController@edit',$row->id) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                    {!! Html::delete('InvoiceController@destroy',$row->id) !!}
                                </td>
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
@include('_partial.data_table_init',['selector'=>'#rows'])
