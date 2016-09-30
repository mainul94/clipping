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
            {!! Form::label('comend','Comend',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('comend',null,['class'=>'form-control','placeholder'=>'Comend']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('status','Status',['class'=>'col-sm-5 control-label']) !!}
            @if(!empty($id) && auth()->user()->type == 'Client')
                <label class="control-label col-sm-7">{!! setStatusLabel($id->status) !!}</label>
            @else
                <div class="col-sm-7">
                    {!! Form::select('status',$setting->taskStatusList() ,null,['class'=>'form-control']) !!}
                </div>
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
                    @if(auth()->user()->type == "Admin" || (auth()->user()->type == "Client") && !empty($id) && $id->status == "Wating for Review")
                        {!! Form::number('total_amount',null,['class'=>'form-control'/*,'disabled'=>'disabled'*/]) !!}
                    @elseif(auth()->user()->type == "Client" && !empty($id))
                        <strong>{!! $id->total_amount !!}</strong>
                    @endif
                </div>
            </div>
        </div>
    @endpermission

</div><!-- /.box-body -->
<div class="box-footer">
    {{--{!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}--}}
</div><!-- /.box-footer -->

@section('script_call')
    @parent
<script>
    getvalueForSelect2("select[name='rejected_task_id']",'tasks',['id','title'],[],'id','title');
    getvalueForSelect2("select[name='client_id']",'users',['id','name'],[['type','Client']],'id','name');

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
</script>
@endsection