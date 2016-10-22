<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group {!! $errors->has('from_address')?'has-error':'' !!}">
            {!! Form::label('from_address','From: Clipping Path Associate',['class'=>'required']) !!}
            <div>
                {!! Form::hidden('client_id',null) !!}
                {!! Form::textarea('from_address', null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder' => 'Address']) !!}
                {!! $errors->first('from_address','<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group {!! $errors->has('to_address')?'has-error':'' !!}">
            {!! Form::label('to_address','To: '.$id->client->name,['class'=>'required']) !!}
            <div>
                {!! Form::textarea('to_address', null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder' => 'Address']) !!}
                {!! $errors->first('to_address','<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group {!! $errors->has('invoice_date')? 'has-error':'' !!}">
            {!! Form::label('invoice_date','Posting Date',['class'=>'required']) !!}
            <div>
                {!! Form::text('invoice_date', null, ['class'=>'form-control col-xs-12']) !!}
                {!! $errors->first('invoice_date','<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group {!! $errors->has('due_date')? 'has-error':'' !!}">
            {!! Form::label('due_date','Due Date',['class'=>'required']) !!}
            <div>
                {!! Form::text('due_date', null, ['class'=>'form-control col-xs-12']) !!}
                {!! $errors->first('due_date','<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group {!! $errors->has('currency')? 'has-error':'' !!}">
            {!! Form::label('currency','Currency',['class'=>'required']) !!}
            <div>
                {!! Form::text('currency', null, ['class'=>'form-control col-xs-12']) !!}
                <span class="help-block"><strong class="text-info">All currency symbol change after save</strong></span>
                {!! $errors->first('currency','<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group {!! $errors->has('paid_amount')? 'has-error':'' !!}">
            {!! Form::label('paid_amount','Paid Amount',['class'=>'required']) !!}
            <div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-{{ strtolower($id->currency) }}"></i></span>
                    {!! Form::text('paid_amount', null, ['class'=>'form-control col-xs-12']) !!}
                </div>
                {!! $errors->first('paid_amount','<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    {{--Children--}}
    <div class="col-xs-12 table" style="background-color: #d3eae9; padding-top: 10px;">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="15%">Date</th>
                <th width="20%">Task ID</th>
                <th width="25%">Task</th>
                <th width="10%">Qty</th>
                <th width="10%">UOM</th>
                <th width="15%">Subtotal</th>
                <th width="5%"></th>
            </tr>
            </thead>
            <tbody class="child-body">
            @foreach($id->children as $sl=>$child)
                <tr class="child-row">
                    <td data-fieldname="task_created_at">{!! $child->task->created_at->format('Y-M-d') !!}</td>
                    <td data-fieldname="task_id">
                        @if(!empty($child) && $child->task)
                            @php $task_id_list = [$child->task->id=>$child->task->id]; $task_id = $child->task->id; @endphp
                        @else
                            @php $task_id_list = []; $task_id = null; @endphp
                        @endif
                        {!! Form::select('task_id[]',$task_id_list,$task_id, ['class'=>'form-control']) !!}
                        {!! Form::hidden('ch_id[]', $child->id) !!}
                    </td>
                    <td data-fieldname="task_title">{!! $child->task->title !!}</td>
                    <td data-fieldname="qty">
                        {!! Form::text('qty[]',(isset($child->qty)?$child->qty:null),['class'=>'form-control', 'onchange'=>'javascript:__total_qty()']) !!}
                    </td>
                    <td data-fieldname="uom">{!! Form::text('uom',(isset($child->uom)?$child->uom:null),['class'=>'form-control']) !!}</td>
                    <td  data-fieldname="amount" class="input-group" @if($sl ==0)style="margin-top: -1px"@endif>
                        <span class="input-group-addon"><i class="fa fa-{{ strtolower($id->currency) }}"></i></span>
                        {!! Form::text('amount[]',(isset($child->amount)?$child->amount:null),['class'=>'form-control', 'onchange'=>'javascript:subtotals()']) !!}
                    </td>
                    <td class="remove">
                        <button type="button" class="btn btn-small text-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--/Children--}}

    <div class="col-sm-6 pull-right">
        <p class="lead">@if(isset($id->invoice_date))Amount Due {!! $id->invoice_date->format('Y-M-d') !!} @endif </p>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td class="input-group">
                        <span class="input-group-addon"><i class="fa fa-{{ strtolower($id->currency) }}"></i></span>
                        {!! Form::text('subtotal', null, ['class' => 'form-control', 'readonly', 'onchange'=>'javascript:__totals()']) !!}
                    </td>
                </tr>
                <tr>
                    <th>Total Qty:</th>
                    <td>
                        {!! Form::text('total_qty', null, ['class' => 'form-control', 'readonly', 'onchange'=>'javascript:__totals()']) !!}
                    </td>
                </tr>
                <tr>
                    <th>Tax </th>
                    <td class="input-group">
                        <span class="input-group-addon"><i class="fa fa-{{ strtolower($id->currency) }}"></i></span>
                        {!! Form::text('tax', null, ['class' => 'form-control', 'onchange'=>'javascript:__totals()']) !!}
                    </td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td class="input-group">
                        <span class="input-group-addon"><i class="fa fa-{{ strtolower($id->currency) }}"></i></span>
                        {!! Form::text('totals', null, ['class' => 'form-control', 'readonly']) !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xs-12">
        {!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}
    </div>

</div>
@section('footer_script')
    @parent
    <script src="{{ asset('vendors/moment/moment.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{!! asset('js/panel.js') !!}"></script>
    <script>
        $('#invoice_date, #due_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_2",
            locale: {
                "format": "YYYY-MM-DD"
            }
        });

        //////////////
        function subtotals() {
            var totals = 0;
            $('.child-body').find('[name^=amount]').each(function (i,el) {
                totals += parseFloat($(el).val())
            });

            $('[name=subtotal]').val(totals).trigger('change')
        }
        //////////////
        function __totals() {
            var totals = parseFloat($('[name=subtotal]').val())+parseFloat($('[name=tax]').val());
            $('[name=totals]').val(totals)
        }
        //////////////
        function __total_qty() {
            var totals = 0;
            $('.child-body').find('[name^=qty]').each(function (i,el) {
                totals += parseFloat($(el).val());
            });
            $('[name=total_qty]').val(totals).trigger('change')
        }
        ///////////
//        $('[name^=amount]').on('change',function () {
//            subtotals()
//        });
    </script>
@endsection