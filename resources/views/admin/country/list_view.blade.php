<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:36 PM
 */
?>
@extends('layouts.admin')
@section('title') Country list @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Country list
                        <small><a class="btn btn-primary pull-right" href="{!! action('CountryController@create') !!}">New</a></small>
                    </h3>
                </div>
                <div class="x_content">
                    @php $rows? $start = ($rows->currentPage()*$rows->perPage())-$rows->perPage(): $start =0 @endphp
                    <table class="table table-bordered" id="rows">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Region</th>
                            <th>Country</th>
                            <th>Slug</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $sl=>$row)
                            <tr>
                                <td>{!! $start + ++$sl !!}</td>
                                <td>{!! $row->region->title or "" !!}</td>
                                <td>{!! $row->title !!}</td>
                                <td>{!! $row->slug !!}</td>
                                <td>{!! $row->createdBy->name or "" !!}</td>
                                <td>{!! $row->updatedBy->name or "" !!}</td>
                                <td class="text-center action-btn-wrapper">
                                    <a class="text-success" href="{!! action('CountryController@show',$row->slug) !!}"><i class="fa fa-eye"></i></a>
                                    <a class="text-warning" href="{!! action('CountryController@edit',$row->slug) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                    {!! Html::delete('CountryController@destroy',$row->slug) !!}
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
