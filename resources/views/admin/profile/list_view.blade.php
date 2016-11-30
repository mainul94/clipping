<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 2:36 PM
 */
?>
@extends('layouts.admin')
@section('title') User list @endsection
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="x_panel">
                <div class="x_title">
                    <h3>User list
                        <small><a class="btn btn-primary pull-right" href="{!! action('UserController@create') !!}">New</a></small>
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
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $sl=>$row)
                            <tr>
                                <td>{!! $start + ++$sl !!}</td>
                                <td>{!! $row->name !!}</td>
                                <td>{!! $row->email !!}</td>
                                <td>
                                    @foreach($row->roles as $role)
                                        <spna>{!! $role->name !!}</spna><br>
                                    @endforeach
                                </td>
                                <td class="text-center action-btn-wrapper">
                                    <a class="text-success" href="{!! action('UserController@show',$row->id) !!}"><i class="fa fa-eye"></i></a>
                                    <a class="text-warning" href="{!! action('UserController@edit',$row->id) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                    {!! Html::delete('UserController@destroy',$row->id) !!}
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
