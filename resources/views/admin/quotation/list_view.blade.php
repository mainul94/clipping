<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:36 PM
 */
?>
@extends('layouts.admin')
@section('title') Quotation list @endsection
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Quotation list
                        <small><a class="btn btn-primary pull-right" href="{!! action('QuotationController@create') !!}">New</a></small>
                    </h3>
                </div>
                <div class="x_content">
                    @php $rows? $start = ($rows->currentPage()*$rows->perPage())-$rows->perPage(): $start =0 @endphp
                    <table class="table table-bordered" id="rows">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Instruction</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $sl=>$row)
                            <tr>
                                <td>{!! $start + ++$sl !!}</td>
                                <td>{!! $row->name !!}</td>
                                <td>{!! $row->email !!}</td>
                                <td>{!! $row->company !!}</td>
                                <td>{!! $row->phone !!}</td>
                                <td>{!! $row->title !!}</td>
                                <td>{!! $row->quantity !!}</td>
                                <td>{!! $row->instruction !!}</td>
                                <td class="text-center action-btn-wrapper">
                                    @permission("view.quotaion")
                                    <a class="text-success" href="{!! action('QuotationController@show',$row->id) !!}"><i class="fa fa-eye"></i></a>
                                    @endpermission
                                    @permission("update.quotaion")
                                    <a class="text-warning" href="{!! action('QuotationController@edit',$row->id) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                    @endpermission
                                    @permission("delete.quotaion")
                                    {!! Html::delete('QuotationController@destroy',$row->id) !!}
                                    @endpermission
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
