<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
<div class="form-group {!! $errors->has('user_id')?'has-error':'' !!}">
    {!! Form::label('user_id','User *',['class'=>'col-md-3 required']) !!}
    <div class="col-xs-12">
        @if(!empty($id) && $id->user)
            @php $user_id_list = [$id->user->id=>$id->user->name]; $user_id = $id->user->id; @endphp
        @else
            @php $user_id_list = []; $user_id = null; @endphp
        @endif
        {!! Form::select('user_id',$user_id_list, $user_id, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('user_id','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('title')? 'has-error':'' !!}">
    {!! Form::label('title','Title',['class'=>'col-md-3']) !!}
    <div class="col-xs-12">
        {!! Form::text('title', null, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('title','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('host')? 'has-error':'' !!}">
    {!! Form::label('host','Host *',['class'=>'col-md-3 required']) !!}
    <div class="col-xs-12">
        {!! Form::text('host', null, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('host','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('username')? 'has-error':'' !!}">
    {!! Form::label('username','Username',['class'=>'col-md-3']) !!}
    <div class="col-xs-12">
        {!! Form::text('username', null, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('username','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('password')? 'has-error':'' !!}">
    {!! Form::label('password','Password',['class'=>'col-md-3']) !!}
    <div class="col-xs-12">
        {!! Form::password('password', ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('password','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('password_confirmation')? 'has-error':'' !!}">
    {!! Form::label('password_confirmation','Confirm Password',['class'=>'col-md-12']) !!}
    <div class="col-md-12">
        {!! Form::password('password_confirmation', ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('password_confirmation','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('port')? 'has-error':'' !!}">
    {!! Form::label('port','Port',['class'=>'col-md-3']) !!}
    <div class="col-xs-12">
        @php $port = empty($id->port)?21:$id->port @endphp
        {!! Form::number('port', $port, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('port','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('root')? 'has-error':'' !!}">
    {!! Form::label('root','Root',['class'=>'col-md-3']) !!}
    <div class="col-xs-12">
        @php $root = empty($id->root)?'/':$id->root @endphp
        {!! Form::text('root', $root, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('root','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('timeout')? 'has-error':'' !!}">
    {!! Form::label('timeout','Timeout',['class'=>'col-md-3']) !!}
    <div class="col-xs-12">
        @php $timeout = empty($id->timeout)?180:$id->timeout @endphp
        {!! Form::number('timeout', $timeout, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('timeout','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3">
        {!! Form::checkbox('ssl',1, null, []) !!} SSL
    </div>
    <div class="col-sm-3">
        {!! Form::checkbox('passive',1, null, []) !!} Passive
    </div>
</div>

<div class="form-group {!! $errors->has('status')?'has-error':'' !!}">
    {!! Form::label('status','Status',['class'=>'col-md-3 required']) !!}
    <div class="col-xs-12">
        {!! Form::select('status',[1=>'Active',0=>'Inactive'], null, ['class'=>'form-control col-xs-12']) !!}
        {!! $errors->first('status','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="col-xs-12">
    {!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}
</div>
@section('script_call')
    @parent
    <script>
        getvalueForSelect2("select[name='user_id']",'users',['id','name'],[],'id','name');
    </script>
@endsection