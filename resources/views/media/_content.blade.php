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

@section('head')
	@parent
	<link rel="stylesheet" href="{!! asset('css/media.css') !!}">
	<link rel="stylesheet" href="{!! asset('media/context-menu/jquery.contextMenu.min.css') !!}">
	{{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
@endsection

@section('script_call')
	@parent
	<script src="{!! asset('media/context-menu/jquery.contextMenu.min.js') !!}"></script>
	{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
	@include('media._call_script')
	<script>
		new MiMedia({
			index_url: '{{ action("ImageController@index") }}',
			directory_url: '{{ action("ImageController@directory") }}',
			image_upload_url: '{{ action("ImageController@store") }}',
			data:{
				root:'/job/{{ $id->id }}'
			}
		}); 
	</script>
@endsection
