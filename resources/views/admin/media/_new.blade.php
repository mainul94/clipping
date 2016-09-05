<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/30/16
 * Time: 2:03 PM
 */?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Dropzone multiple file uploader</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<p>Drag multiple files to the box below for multi upload or click to select files.</p>
				{!! Form::open(['action'=>'MediaController@store', 'class'=>'dropzone', 'files'=>true]) !!}
				{!! Form::close() !!}
				<br />
				<br />
				<br />
				<br />
			</div>
		</div>
	</div>
</div>
@section('head')
	@parent
	<!-- Dropzone.js -->
	<link href="{!! asset('vendors/dropzone/dist/min/dropzone.min.css') !!}" rel="stylesheet">
@endsection

@section('footer_script')
	@parent
	<!-- Dropzone.js -->
	<script src="{!! asset('vendors/dropzone/dist/min/dropzone.min.js') !!}"></script>
@endsection
@section('script_call')
	<script>

	</script>
@endsection
