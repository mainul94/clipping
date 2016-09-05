<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 4:44 PM
 */
?>
<div class="col-md-9">
    <div class="form-group {!! $errors->has('title')?'has-error':'' !!}">
        {!! Form::label('title','Title *',['class'=>'col-md-3 required']) !!}
        <div class="col-xs-12">
            {!! Form::text('title', null, ['class'=>'form-control col-xs-12']) !!}
            {!! $errors->first('title','<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {!! $errors->has('slug')? 'has-error':'' !!}">
        {!! Form::label('slug','Slug',['class'=>'col-md-3 required']) !!}
        <div class="col-xs-12">
            {!! Form::text('slug', null, ['class'=>'form-control col-xs-12']) !!}
            {!! $errors->first('slug','<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {!! $errors->has('category_id')? 'has-error':'' !!}">
        {!! Form::label('category_id','Category',['class'=>'col-md-3 required']) !!}
        <div class="col-xs-12">
			@php $categories = !empty($id) && $id->categories ? $id->categories->lists('title','id'):[] @endphp
            {!! Form::select('category_id[]',$categories, null, ['class'=>'form-control col-xs-12', 'multiple']) !!}
            {!! $errors->first('category_id','<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {!! $errors->has('content')? 'has-error':'' !!}">
        {!! Form::label('content','Description',['class'=>'col-md-3']) !!}
        <div class="col-xs-12">
            {!! Form::textarea('content', null, ['class'=>'form-control col-xs-12']) !!}
            {!! $errors->first('content','<span class="help-block">:message</span>') !!}
        </div>
    </div>

	<div class="form-group {!! $errors->has('related_id')? 'has-error':'' !!}">
		{!! Form::label('related_id','Related Article',['class'=>'col-md-3 required']) !!}
		<div class="col-xs-12">
			@php $related = !empty($id) && $id->relatedArticles ? $id->relatedArticles->lists('title','id'):[] @endphp
			{!! Form::select('related_id[]',$related, null, ['class'=>'form-control col-xs-12', 'multiple']) !!}
			{!! $errors->first('related_id','<span class="help-block">:message</span>') !!}
		</div>
	</div>

    <div class="form-group {!! $errors->has('summery')? 'has-error':'' !!}">
        {!! Form::label('summery','Summery',['class'=>'col-md-3']) !!}
        <div class="col-xs-12">
            {!! Form::textarea('summery', null, ['class'=>'form-control col-xs-12']) !!}
            {!! $errors->first('summery','<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
<div class="col-md-3">
    @include('admin.article._form_right_side')
</div>

<div class="col-xs-12">
    {!! Form::submit('Save',['class'=>'btn btn-info pull-right']) !!}
</div>

@section('footer_script')
    @parent
    <!-- include summernote css/js-->
    <link href="{!! asset('vendors/summernote/css/summernote.css') !!}" rel="stylesheet">
    <script src="{!! asset('vendors/summernote/js/summernote.js') !!}"></script>
    <script src="{!! asset('js/panel.js') !!}"></script>
    <script>
        $('[name=content]').summernote({
            height:200
        });
        $('[name=summery]').summernote({
            height:100
        });

        getvalueForSelect2('[name^=category_id]','categories',['id','title'],[],'id','title');
        getvalueForSelect2('[name^=related_id]','articles',['id','title'],[],'id','title');
    </script>
@endsection