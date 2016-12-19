<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/11/16
 * Time: 7:37 PM
 */?>
<div class="comment-item">
	<div class="col-sm-1">
		<div class="thumbnail">
			<img class="img-responsive user-photo" src="{!! $comment->createdBy->profile->avatar or 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png' !!}">
		</div><!-- /thumbnail -->
	</div><!-- /col-sm-1 -->

	<div class="col-sm-11">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>{!! $comment->createdBy->name !!}</strong> <span class="text-muted">{!! $comment->created_at->diffForHumans() !!}</span>
				<span class="text-muted pull-right"><a onclick="comment_form(this)" href="javascript:void(0)"
					data-parent-type="{!! $comment->parent_type !!}" data-parent="{!! $comment->parent !!}"
                    data-comment-id="{!! $comment->id !!}" data-title="Leave a  Reply">Reply</a></span>
			</div>
			<div class="panel-body">
				{!! $comment->comment !!}
			</div><!-- /panel-body -->
		</div><!-- /panel panel-default -->
	</div><!-- /col-sm-11 -->
	@foreach($comment->childrenComments as $comment)
		@include('admin.comment._row')
	@endforeach
</div>
