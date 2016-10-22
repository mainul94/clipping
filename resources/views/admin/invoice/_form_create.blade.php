<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/21/16
 * Time: 9:45 AM
 */?>

<div class="form-group col-sm-3 {!! $errors->has('from_date')? 'has-error':'' !!}">
	{!! Form::label('from_date','From',['class'=>'col-md-3 required']) !!}
	<div class="col-xs-12">
		{!! Form::text('from_date', null, ['class'=>'form-control col-xs-12']) !!}
		{!! $errors->first('from_date','<span class="help-block">:message</span>') !!}
	</div>
</div>

<div class="form-group col-sm-3 {!! $errors->has('to_date')? 'has-error':'' !!}">
	{!! Form::label('to_date','To',['class'=>'col-md-3 required']) !!}
	<div class="col-xs-12">
		{!! Form::text('to_date', null, ['class'=>'form-control col-xs-12']) !!}
		{!! $errors->first('to_date','<span class="help-block">:message</span>') !!}
	</div>
</div>


<div class="form-group col-sm-3 {!! $errors->has('client_id')? 'has-error':'' !!}">
	{!! Form::label('client_id','Client') !!}
	<div class="col-sm-12">
		@if(!empty($id) && $id->client)
			@php $client_id_list = [$id->client->id=>$id->client->name]; $client_id = $id->client->id; @endphp
		@else
			@php $client_id_list = []; $client_id = null; @endphp
		@endif
		{!! Form::select('client_id',$client_id_list,$client_id,['class'=>'form-control','placeholder'=>'']) !!}
		{!! $errors->first('client_id','<span class="help-block">:message</span>') !!}
	</div>
</div>

<div class="col-sm-3">
	<br>
	{!! Form::submit('Generate',['class'=>'btn btn-info pull-right']) !!}
</div>
@section('footer_script')
	@parent
	<script src="{{ asset('vendors/moment/moment.js') }}"></script>
	<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<script>
		getvalueForSelect2("select[name='client_id']",'users',['id','name'],[['type','Client']],'id','name');

		$('#from_date').daterangepicker({
			singleDatePicker: true,
			calender_style: "picker_2",
			locale: {
				"format": "YYYY-MM-DD"
			}
		});
		$('#to_date').daterangepicker({
			singleDatePicker: true,
			calender_style: "picker_2",
			locale: {
				"format": "YYYY-MM-DD"
			}
		});
	</script>
@endsection