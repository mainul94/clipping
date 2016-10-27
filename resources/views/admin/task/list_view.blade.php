<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/3/16
 * Time: 11:23 PM
 */
?>
@extends('layouts.admin')

@push('title') Task List @endpush

{{--@section('content-header')--}}
    {{--@include('_partial.breadcrumb',['breadcrumb_title'=>'Task List'])--}}
{{--@endsection--}}

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>All Taks {{ auth()->user()->type }}</h3>
                    </div><!-- /.box-header -->
                    <div class="x_content">
                        <table id="rows" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Title</th>
                                <th>Total Qty</th>
                                @permission("priceview.task")
                                <th>Total Amount</th>
                                @endpermission
                                <th>Type</th>
                                <th>Delivery</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $task)
                                @include('admin.task.row',['task'=>$task])
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Task ID</th>
                                <th>Title</th>
                                <th>Total Qty</th>
                                @permission("priceview.task")
                                <th>Total Amount</th>
                                @endpermission
                                <th>Type</th>
                                <th>Delivery</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
@endsection
