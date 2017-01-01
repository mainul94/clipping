<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:36 PM
 */
?>
@extends('layouts.admin')
@section('title') FTP list @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>FTP List
                        <small><a class="btn btn-primary pull-right" href="{!! action('FTPController@create') !!}">New</a></small>
                    </h3>
                </div>
                <div class="x_content">
                    @php $rows? $start = ($rows->currentPage()*$rows->perPage())-$rows->perPage(): $start =0 @endphp
                    <table class="table table-bordered" id="rows">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Host</th>
                            <th>Username</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $sl=>$row)
                            <tr>
                                <td>{!! $start + ++$sl !!}</td>
                                <td><a href="{!! action('ProfileController@show',[$row->user->id])!!}">{!! $row->user->name !!}</a></td>
                                <td>{!! $row->user->email !!}</td>
                                <td>{!! $row->host !!}</td>
                                <td>{!! $row->username !!}</td>
                                <td>{!! $row->createdBy->name or "" !!}</td>
                                <td>{!! $row->updatedBy->name or "" !!}</td>
                                <td class="text-center action-btn-wrapper">
                                    <a class="text-success" href="{!! action('FTPController@show',$row->id) !!}"><i class="fa fa-eye"></i></a>
                                    <a class="text-warning" href="{!! action('FTPController@edit',$row->id) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                    {!! Html::delete('FTPController@destroy',$row->id) !!}
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
