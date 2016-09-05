<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
<div class="form-group {!! $errors->has('feature_image')?'has-error':'' !!}">
    <div class="col-xs-12">
		<button class="btn btn-sm" type="button" id="">Brows</button>
		{!! Form::hidden('feature_image', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
		{!! Form::text('feature_caption', null, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder' => 'Caption']) !!}
		{!! $errors->first('feature_image','<span class="help-block">:message</span>') !!}
	</div>
	{!! Form::label('feature_image','Feature Image',['class'=>'col-xs-12 required']) !!}
</div>

<div class="form-group {!! $errors->has('bg_color')? 'has-error':'' !!}">
    {!! Form::label('bg_color','Background Color',['class'=>'col-xs-12 required']) !!}
    <div class="col-xs-12">
		<div class="input-group bg_color colorpicker-element">
			@php $bg_color = !empty($id) && $id->bg_color ? $id->bg_color: '#00627B' @endphp
			{!! Form::text('bg_color', $bg_color, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'#1820d9']) !!}
			<span class="input-group-addon"><i></i></span>
		</div>
		{!! $errors->first('bg_color','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('sidebar_bg_color')? 'has-error':'' !!}">
    {!! Form::label('sidebar_bg_color','Slide Background Color',['class'=>'col-xs-12 required']) !!}
    <div class="col-xs-12">
		<div class="input-group sidebar_bg_color colorpicker-element">
			@php $sidebar_bg_color = !empty($id) && $id->sidebar_bg_color ? $id->sidebar_bg_color: '#00627B' @endphp
			{!! Form::text('sidebar_bg_color', $sidebar_bg_color, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'#1820d9']) !!}
			<span class="input-group-addon"><i></i></span>
		</div>
		{!! $errors->first('sidebar_bg_color','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('slide_id')? 'has-error':'' !!}">
    {!! Form::label('slide_id','Slide',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-xs-12">
		@php $slides = !empty($id) && $id->slide ? $id->slide->lists('title','id') : [] @endphp
        {!! Form::select('slide_id',$slides, null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('slide_id','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('slide_position')? 'has-error':'' !!}">
    {!! Form::label('slide_position','Slide Positon',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-xs-12">
        {!! Form::select('slide_position',['Top'=>'Top', 'Bottom'=>'Bottom'], null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('slide_position','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('template')? 'has-error':'' !!}">
    {!! Form::label('template','Template',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-xs-12">
        {!! Form::select('template',['Default'=>'Default'], null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('template','<span class="help-block">:message</span>') !!}
    </div>
</div>
@section('head')
	@parent<!-- Bootstrap Colorpicker -->
	<link href="{!! asset('vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') !!}" rel="stylesheet">
@endsection

@section('footer_script')
	@parent
	<!-- Bootstrap Colorpicker -->
	<script src="{!! asset('vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}"></script>
	<script>
		$('.bg_color').colorpicker();
		$('.sidebar_bg_color').colorpicker();
	</script>
@endsection