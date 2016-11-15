<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/6/16
 * Time: 8:16 PM
 */
?>
<div class="container comment">
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<h3>Comments</h3>
		</div><!-- /col-sm-12 -->
	</div><!-- /row -->
	<div class="row">
		@foreach($row->comments as $comment)
			@include('admin.comment._row')
		@endforeach
	</div><!-- /row -->
	<hr>
</div><!-- /container -->
@section('footer_script')
	@parent
	<!-- include summernote css/js-->
	<link href="{!! asset('vendors/summernote/css/summernote.css') !!}" rel="stylesheet">
	<script src="{!! asset('vendors/summernote/js/summernote.js') !!}"></script>
	<script>
		function comment_form(e,options) {
			if (typeof options === "undefined") {
				options = {}
			}
			if (typeof e !== "undefined" && e) {
				options.title = $(e).data('title');
				options.parent_type = $(e).data('parent-type');
				options.parent = $(e).data('parent');
				options.comment_id = $(e).data('comment-id');
				var $comment_wrapper = $($(e).closest('.panel')).find('.panel-body:last');
			}else
			{
				var $comment_wrapper = $('.container.comment');
			}
			var $comment = $('<div class="row comment-form">').appendTo($comment_wrapper);
			var $comment_title = $('<h2>');
			$comment_title.html(options.title || 'Leave a comment').appendTo($comment);
			var $comment_form = $('<form>').appendTo($comment);
			$comment_form.append('<input name="_token" type="hidden" value="{{ csrf_token() }}">');
			$comment_form.append('<input name="parent_type" type="hidden" value="'+(options.parent_type || 'Task')+'">');
			$comment_form.append('<input name="parent" type="hidden" value="'+(options.parent || '{{ $row->id or null }}')+'">');
			if (typeof options.comment_id !== "undefined") {
				$comment_form.append('<input name="comment_id" type="hidden" value="'+options.comment_id+'">');
			}
			var $comment_field = $('<textarea>').appendTo($comment_form);
			$comment_field.attr('name','comment').summernote({
				height:100
			});

			$comment_form.attr({
				'action':'{{ action("CommentController@store") }}',
				'method': 'POST'
			});
			// add submit button
			var $comment_form_submit_btn = $('<input type="submit">').appendTo($comment_form);
			$comment_form_submit_btn.addClass('btn btn-info')
		}

		comment_form()
	</script>
@endsection