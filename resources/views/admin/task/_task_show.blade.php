<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/8/16
 * Time: 12:49 AM
 */
?>
{{--@include('_include.error')--}}
<div class="x_content">
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Title</strong>
        <div class="col-sm-8">
            {!! $id->title !!}
        </div>
    </div>
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Referance</strong>
        <div class="col-sm-8">
            {!! $id->referance !!}
        </div>
    </div>
    @permission("view.client.name")
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Client</strong>
        <div class="col-sm-8">
            {!! $id->client->name !!}
        </div>
    </div>
    @endpermission
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Total Qty</strong>
        <div class="col-sm-8">
            {!! $id->total_qty !!}
        </div>
    </div>
    @permission("priceview.task")
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Total Amount</strong>
        <div class="col-sm-8">
            {!! $id->total_amount !!}
        </div>
    </div>
    @endpermission
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Delivery</strong>
        <div class="col-sm-8">
            {!! $id->delivery->format('Y-m-d H:i:s') !!}
        </div>
    </div>
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Instruction</strong>
        <div class="col-sm-8">
            {!! $id->instruction !!}
        </div>
    </div>
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Comend</strong>
        <div class="col-sm-8">
            {!! $id->comend !!}
        </div>
    </div>
    <div class="row padding-vertical-p5em">
        <strong class="col-sm-3">Status</strong>
        <div class="col-sm-8">
            {!! $id->status !!}
        </div>
    </div>
</div><!-- /.box-body -->
<div class="clearfix"></div>
<div class="box-footer">
    {{--{!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}--}}
</div><!-- /.box-footer -->