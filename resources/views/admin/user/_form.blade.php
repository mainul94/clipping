<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
<div class="form-group {!! $errors->has('name')?'has-error':'' !!}">
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
</div>

<div class="form-group {!! $errors->has('password')? 'has-error':'' !!}">
    {!! Form::label('password','Password',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::password('password', ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('password','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('password_confirmation')? 'has-error':'' !!}">
    {!! Form::label('password_confirmation','Confirm Password',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::password('password_confirmation', ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('password_confirmation','<span class="help-block">:message</span>') !!}
    </div>
</div>

{{--<div class="form-group {!! $errors->has('role_id')? 'has-error':'' !!}">
    {!! Form::label('role_id','Role',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        @php $roles = !empty($id) && $id->roles?$id->roles->lists('name','id'):[] @endphp
        {!! Form::select('role_id[]',$roles, null, ['class'=>'form-control col-md-7 col-xs-12', 'multiple']) !!}
        {!! $errors->first('role_id','<span class="help-block">:message</span>') !!}
    </div>
</div>--}}
@include('admin.user._roles')
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