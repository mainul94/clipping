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
		{{--<div class="comment-item">
			<div class="col-sm-1">
				<div class="thumbnail">
					<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
				</div><!-- /thumbnail -->
			</div><!-- /col-sm-1 -->

			<div class="col-sm-11">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
					</div>
					<div class="panel-body">
						Panel content
					</div><!-- /panel-body -->
				</div><!-- /panel panel-default -->
			</div><!-- /col-sm-11 -->
			<div class="comment-item">
				<div class="col-sm-1">
					<div class="thumbnail">
						<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
					</div><!-- /thumbnail -->
				</div><!-- /col-sm-1 -->

				<div class="col-sm-11">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
						</div>
						<div class="panel-body">
							Panel content
						</div><!-- /panel-body -->
					</div><!-- /panel panel-default -->
				</div><!-- /col-sm-11 -->
			</div>
			<div class="comment-item">
				<div class="col-sm-1">
					<div class="thumbnail">
						<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
					</div><!-- /thumbnail -->
				</div><!-- /col-sm-1 -->

				<div class="col-sm-11">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
						</div>
						<div class="panel-body">
							Panel content
						</div><!-- /panel-body -->
					</div><!-- /panel panel-default -->
				</div><!-- /col-sm-11 -->
			</div>
		</div>--}}
	</div><!-- /row -->
	<hr>
	<div class="row comment-form">
		{!! Form::open(['action'=>'CommentController@store']) !!}
			<div class="col-xs-12">
				<h2>Leave a comment</h2>
			</div>
			@include('admin.comment._form',['row'=>collect(['parent_type'=>'Task', 'parent'=>$row->id])])
		{!! Form::close() !!}
	</div>
</div><!-- /container -->