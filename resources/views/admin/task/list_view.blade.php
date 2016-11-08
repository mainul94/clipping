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
                        {{--Filters--}}
                        @include('_partial.filters',['filter_url'=>action('TaskController@index')])
                        {{--Data--}}
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
@section('footer_script')
    @parent
    <script>

        filedsOptions = {
            "title": {
                "label": "Title",
                "filed_name": "title",
                "filed_type": "Data",
                "field_options": null
            },
            "delivery": {
                "label": "Delivery Date",
                "filed_name": "delivery_date",
                "filed_type": "Date",
                "field_options": null
            },
            "status": {
                "label": "Status",
                "filed_name": "status",
                "filed_type": "Select",
                "field_options": [
                    {'id': 'Wating for Review','text': 'Wating for Review'},
                    {'id': 'Accepted','text': 'Accepted'},
                    {'id': 'Processing', 'text': 'Processing'},
                    {'id': 'Rejected', 'text': 'Rejected'},
                    {'id': 'Completed', 'text': 'Completed'},
                    {'id':'Finished', 'text': 'Finished'},
                    {'id': 'Hold', 'text': 'Hold'}
                ],
                "default": "Processing"
            }
        };
    </script>
@endsection