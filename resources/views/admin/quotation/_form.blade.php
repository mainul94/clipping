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
        {!! Form::text('email', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('email','<span class="help-block">:message</span>') !!}
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

<div class="form-group {!! $errors->has('title')? 'has-error':'' !!}">
    {!! Form::label('title','Title',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('title', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('title','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('instruction')? 'has-error':'' !!}">
    {!! Form::label('instruction','Instruction',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-9">
        {!! Form::textarea('instruction', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('instruction','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('quantity')? 'has-error':'' !!}">
    {!! Form::label('quantity','Quantity',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        {!! Form::text('quantity', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('quantity','<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('','Sample Image',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-7">
        <div class="col-sm-4 quotation-thumbnail-wrapper">
            @if(!empty($id) && isset($id->sample_one))
                <img class="img-responsive img-thumbnail" src="{!! asset($id->sample_one) !!}" alt="">
            @endif
            {!! Form::file('sample_one') !!}
        </div>
        <div class="col-sm-4 quotation-thumbnail-wrapper">
            @if(!empty($id) && isset($id->sample_two))
                <img class="img-responsive img-thumbnail" src="{!! asset($id->sample_two) !!}" alt="">
            @endif
            {!! Form::file('sample_two') !!}
        </div>
        <div class="col-sm-4 quotation-thumbnail-wrapper">
            @if(!empty($id) && isset($id->sample_three))
                <img class="img-responsive img-thumbnail" src="{!! asset($id->sample_three) !!}" alt="">
            @endif
            {!! Form::file('sample_three') !!}
        </div>
        <div class="col-sm-4 quotation-thumbnail-wrapper">
            @if(!empty($id) && isset($id->sample_four))
                <img class="img-responsive img-thumbnail" src="{!! asset($id->sample_four) !!}" alt="">
            @endif
            {!! Form::file('sample_four') !!}
        </div>
        <div class="col-sm-4 quotation-thumbnail-wrapper">
            @if(!empty($id) && isset($id->sample_five))
                <img class="img-responsive img-thumbnail" src="{!! asset($id->sample_five) !!}" alt="">
            @endif
            {!! Form::file('sample_five') !!}
        </div>
    </div>
</div>


<div class="form-group {!! $errors->has('comment')? 'has-error':'' !!}">
    {!! Form::label('comment','Comment',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-9">
        {!! Form::textarea('comment', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('comment','<span class="help-block">:message</span>') !!}
    </div>
</div>


<div class="form-group {!! $errors->has('status')? 'has-error':'' !!}">
    {!! Form::label('status','Status',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-9">
        {!! Form::select('status', ['Pending'=>'Pending', 'Accepted'=>'Accepted', 'Processing'=>'Processing',
        'Finished'=>'Finished', 'Hold'=>'Hold'], null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
        {!! $errors->first('status','<span class="help-block">:message</span>') !!}
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
        $('[name=instruction]').summernote({
            height:200
        });
    </script>
@endsection