<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
{{--<div class="form-group {!! $errors->has('name')?'has-error':'' !!}">
    {!! Form::label('name','Name *',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-md-7">
        {!! Form::text('name', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('name','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('email')? 'has-error':'' !!}">
    {!! Form::label('email','Email *',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-md-7">
        {!! Form::email('email', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('email','<span class="help-block">:message</span>') !!}
    </div>
</div>--}}

<div class="form-group {!! $errors->has('avatar')? 'has-error':'' !!}">
    {!! Form::label('avatar','Avatar',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        @if(!empty($id->avatar))
            <img src="{{ $id->avatar }}" alt="{{ auth()->user()->name }}" class="img-responsive img-thumbnail">
        @endif
        {!! Form::file('avatar', null, ['class'=>'col-md-7 col-xs-12']) !!}
        {!! $errors->first('avatar','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('phone')? 'has-error':'' !!}">
    {!! Form::label('phone','Phone',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('phone', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('phone','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('company')? 'has-error':'' !!}">
    {!! Form::label('company','Company',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('company', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('company','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('designation')? 'has-error':'' !!}">
    {!! Form::label('designation','Designation',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('designation', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('designation','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('address')? 'has-error':'' !!}">
    {!! Form::label('address','Address',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('address', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('address','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('country')? 'has-error':'' !!}">
    {!! Form::label('country','Country',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('country', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('country','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('web')? 'has-error':'' !!}">
	{!! Form::label('web','Web',['class'=>'control-label col-md-3']) !!}
	<div class="col-md-7">
		{!! Form::text('web', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
		{!! $errors->first('web','<span class="help-block">:message</span>') !!}
	</div>
</div>


<div class="form-group {!! $errors->has('bio')? 'has-error':'' !!}">
	{!! Form::label('bio','Bio',['class'=>'control-label col-md-3']) !!}
	<div class="col-md-7">
		{!! Form::textarea('bio', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
		{!! $errors->first('bio','<span class="help-block">:message</span>') !!}
	</div>
</div>


<div class="col-xs-12">
    {!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}
</div>

@section('footer_script')
    @parent
    <script src="{!! asset('js/panel.js') !!}"></script>
    <script>
//        getvalueForSelect2('[name^=role_id]','roles',['id','name'],[],'id','name');
    </script>
@endsection