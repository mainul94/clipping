<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
<div class="form-group {!! $errors->has('name')?'has-error':'' !!}">
    {!! Form::label('name','Title *',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-md-7">
        {!! Form::text('name', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('name','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('slug')? 'has-error':'' !!}">
    {!! Form::label('slug','Slug *',['class'=>'control-label col-md-3 required']) !!}
    <div class="col-md-7">
        {!! Form::text('slug', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('slug','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('model')? 'has-error':'' !!}">
    {!! Form::label('model','Model',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('model', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('model','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('description')? 'has-error':'' !!}">
    {!! Form::label('description','Description',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-9">
        {!! Form::textarea('description', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('description','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="col-xs-12">
    {!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}
</div>

@section('footer_script')
    <!-- include summernote css/js-->
    <link href="{!! asset('vendors/summernote/css/summernote.css') !!}" rel="stylesheet">
    <script src="{!! asset('vendors/summernote/js/summernote.js') !!}"></script>
    <script>
        $('[name=description]').summernote({
            height:200
        });
    </script>
@endsection