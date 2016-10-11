<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/6/16
 * Time: 11:27 PM
 */?>

{{--<div class="form-group {!! $errors->has('title')?'has-error':'' !!}">
	{!! Form::label('title','Title *',['class'=>'col-md-3 required']) !!}
	<div class="col-xs-12">
		{!! Form::text('title', null, ['class'=>'form-control col-xs-12']) !!}
		{!! $errors->first('title','<span class="help-block">:message</span>') !!}
	</div>
</div>--}}
<div class="form-group {!! $errors->has('comment')? 'has-error':'' !!}">
	{!! Form::label('comment','Comment',['class'=>'col-md-3']) !!}
	<div class="col-xs-12">
		{!! Form::textarea('comment', null, ['class'=>'form-control col-xs-12']) !!}
		{!! Form::hidden('parent_type',$row->get('parent_type')) !!}
		{!! Form::hidden('parent',$row->get('parent')) !!}
		{!! $errors->first('comment','<span class="help-block">:message</span>') !!}
	</div>
</div>

<div class="col-xs-12">
	{!! Form::submit('Comment',['class'=>'btn btn-info']) !!}
</div>

@section('footer_script')
	@parent
	<!-- include summernote css/js-->
	<link href="{!! asset('vendors/summernote/css/summernote.css') !!}" rel="stylesheet">
	<script src="{!! asset('vendors/summernote/js/summernote.js') !!}"></script>
	<script>
		$('[name=comment]').summernote({
			height:100
		});
	</script>
@endsection