<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/18/16
 * Time: 8:51 PM
 */
?>
<div class="row init-media">

</div>
{{--<div class="row">
	<div class="mi-media-wrapper">
		<div class="section-title">Folders</div>
		<div class="mi-folder-wrapper">
			--}}{{--Folder--}}{{--
			<div class="mi-folder-sub-wrapper selected">
				<div class="folder-icon">
					<i class="fa fa-folder"></i>
				</div>
				<div class="folder-text">
					<span>Test Folder</span>
				</div>
			</div>
			--}}{{--/Folder--}}{{--
			--}}{{--Folder--}}{{--
			<div class="mi-folder-sub-wrapper">
				<div class="folder-icon">
					<i class="fa fa-folder"></i>
				</div>
				<div class="folder-text">
					<span>Test Folder</span>
				</div>
			</div>
			--}}{{--/Folder--}}{{--
			--}}{{--Folder--}}{{--
			<div class="mi-folder-sub-wrapper">
				<div class="folder-icon">
					<i class="fa fa-folder"></i>
				</div>
				<div class="folder-text">
					<span>Test Folder</span>
				</div>
			</div>
			--}}{{--/Folder--}}{{--
			--}}{{--Folder--}}{{--
			<div class="mi-folder-sub-wrapper">
				<div class="folder-icon">
					<i class="fa fa-folder"></i>
				</div>
				<div class="folder-text">
					<span>Test Folder</span>
				</div>
			</div>
			--}}{{--/Folder--}}{{--
			--}}{{--Folder--}}{{--
			<div class="mi-folder-sub-wrapper">
				<div class="folder-icon">
					<i class="fa fa-folder"></i>
				</div>
				<div class="folder-text">
					<span>Test Folder</span>
				</div>
			</div>
			--}}{{--/Folder--}}{{--
		</div>
		<div class="section-title">Files</div>
		<div class="mi-file-wrapper">
			<div class="mi-file-sub-wrapper">
				<div class="thumbnail-image">
				<img src="{!! auth()->user()->profile->avatar !!}" alt="">
				</div>
				<div class="text">
					<div class="folder-icon">
						<i class="fa fa-picture-o" aria-hidden="true"></i>
					</div>
					<div class="folder-text">
						<span>sd</span>
					</div>
				</div>
			</div>
			<div class="mi-file-sub-wrapper selected">
				<div class="thumbnail-image">
					<img src="/avatar/14820763672016-10-18-103726.jpg" alt="">
				</div>
				<div class="text">
					<div class="folder-icon">
						<i class="fa fa-picture-o" aria-hidden="true"></i>
					</div>
					<div class="folder-text">
						<span>Test Foldeasdfasdf asdf  asdf asd fasdf asf r</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>--}}
@section('head')
	@parent
	<link rel="stylesheet" href="{!! asset('css/media.css') !!}">
	<link rel="stylesheet" href="{!! asset('media/context-menu/jquery.contextMenu.min.css') !!}">
@endsection

@section('footer_script')
	@parent
	<script src="{!! asset('media/context-menu/jquery.contextMenu.min.js') !!}"></script>
	@include('media._call_script')
	<script>
		new MiMedia({
			index_url: '{{ action("ImageController@index") }}',
			data:{
				root:'/job/{{ $id->id }}/Done'
			}
		});
	</script>
@endsection
