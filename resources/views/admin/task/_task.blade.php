<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/8/16
 * Time: 12:49 AM
 */
?>
{{--@include('_include.error')--}}
<!-- .box-header -->
<div class="x_header">
    {!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}
</div><!-- /.box-header -->
<div class="x_content">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('title','Title',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('delivery','Delivery',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                @if(!empty($id))
                    @php $delivery = $id->delivery->format('Y-m-d H:i:s') @endphp
                @else
                    @php $delivery = null @endphp
                @endif
                {!! Form::text('delivery',$delivery,['class'=>'form-control','placeholder'=>'Delivery Date']) !!}
            </div>
        </div>
        @permission("view.client.name")
        @if(auth()->user()->type == 'Admin')
            <div class="form-group">
                {!! Form::label('client_id','Client',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    @if(!empty($id) && $id->client)
                        @php $client_id_list = [$id->client->id=>$id->client->name]; $client_id = $id->client->id; @endphp
                    @else
                        @php $client_id_list = []; $client_id = null; @endphp
                    @endif
                    {!! Form::select('client_id',$client_id_list,$client_id,['class'=>'form-control','placeholder'=>'']) !!}
                </div>
            </div>
        @endif
        @endpermission
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('referance','Referance',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('referance',null,['class'=>'form-control','placeholder'=>'Referance']) !!}
            </div>
        </div>

        <div class="form-group hide">
            {!! Form::label('type','Type',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('type',$setting->taskTypeList(),null,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('rejected_task_id','Prev Job No',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('rejected_task_id',[],null,['class'=>'form-control','placeholder'=>'']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('instruction','Instruction',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('instruction',null,['class'=>'form-control','placeholder'=>'Instruction']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('ftp_id','FTP',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                @if(empty($id))
                    {!! Form::select('ftp_id',[],null,['class'=>'form-control','placeholder'=>'Default']) !!}
                @elseif(!empty($id->ftp))
                    <div class="col-md-3 col-xs-12 widget widget_tally_box">
                        <div class="x_panel fixed_height_390">
                            <div class="x_title">
                                <h2>Sales Close</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content" style="display: block;">
                                <ul class="legend list-unstyled">
                                    <li>
                                        <p>
                                            <span class="col-sm-4">Title:</span><span class="col-sm-8">{!! $id->ftp->title or "" !!}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="col-sm-4">Host:</span><span class="col-sm-8">{!! $id->ftp->host or "" !!}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="col-sm-4">User:</span><span class="col-sm-8">{!! $id->ftp->username or "" !!}</span>
                                        </p>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('comend','Comend',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('comend',null,['class'=>'form-control','placeholder'=>'Comend']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('status','Status',['class'=>'col-sm-5 control-label']) !!}
            @if(auth()->user()->type == 'Admin')
                <div class="col-sm-7">
                    {!! Form::select('status',$setting->taskStatusList(), null,['class'=>'form-control']) !!}
                </div>
            @elseif(!empty($id))
                <label class="control-label col-sm-7">{!! Html::taskStatusLabel($id->status) !!}</label>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('total_qty','Total Qty',['class'=>'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::number('total_qty',null,['class'=>'form-control'/*,'disabled'=>'disabled'*/]) !!}
            </div>
        </div>
    </div>
    @permission("view.task.price")
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('total_amount','Total Amount',['class'=>'col-sm-5 control-label']) !!}
                <div class="col-sm-7">
                    @if(auth()->user()->type == "Admin")
                        {!! Form::number('total_amount',null,['class'=>'form-control'/*,'disabled'=>'disabled'*/]) !!}
                    @elseif((auth()->user()->type == "Client" && empty($id)) || (auth()->user()->type == "Client" && $id->status =="Wating for Review"))
                        {!! Form::number('total_amount',null,['class'=>'form-control'/*,'disabled'=>'disabled'*/]) !!}
                    @else
                        <strong>{!! $id->total_amount !!}</strong>
                    @endif
                </div>
            </div>
        </div>
    @endpermission

</div><!-- /.box-body -->
<div class="clearfix"></div>
<div class="box-footer">
    {{--{!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}--}}
</div><!-- /.box-footer -->
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('footer_script')
    @parent
    <script src="{{ asset('vendors/moment/moment.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('script_call')
    @parent
<script>
    var $ftp_filters = '';
    @if(auth()->user()->type == 'Client')
        $ftp_filters = ['user_id', "{!! auth()->user()->id !!}"];
    @endif
    getvalueForSelect2("select[name='rejected_task_id']",'tasks',['id','title'],[],'id','title');
    getvalueForSelect2("select[name='client_id']",'users',['id','name'],[['type','Client']],'id','name');
    getvalueForSelect2("select[name='ftp_id']",'ftps',['id','title'],[$ftp_filters],'id','title',null,['Default','Default']);

    //    Set Reject job Id on chagne type;
    $('[name="type"]').on('change',function () {
        var me = $(this);
        var task_field = $("select[name='rejected_task_id']");
        var task_field_parent = task_field.parents('.form-group');
        if (me.val()=="Rejected") {
            task_field_parent.show();
        }else {
            task_field_parent.hide();
            task_field.val(null);
        }
    }).change();
    ///////////
    var prev_val = $('#delivery').val() || moment();
    $('#delivery').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        calender_style: "picker_2",
        timePicker24Hour:true,
        startDate:prev_val,
        endDate:prev_val,
        locale:{
            format:'YYYY-MM-DD hh:mm:ss'
        }
    });
</script>
@endsection