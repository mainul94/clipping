<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/8/16
 * Time: 1:00 AM
 */

        ?>
@extends('layouts.admin')

@push('title') Task Edit @endpush


{{--@section('content-header')--}}
    {{--@include('_partial.breadcrumb',['breadcrumb_title'=>'Task Edit'])--}}
{{--@endsection--}}
@section('content')
<div class="content">
    <div class="x_panel">
        <!-- Upload Images Modal -->
        <div class="x_header">
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#uploadImages">
            Upload Images
        </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="uploadImages" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Images Upload</h4>
                    </div>
                    <div class="modal-body">
                                <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#directUpload" aria-controls="directUpload" role="tab" data-toggle="tab">Direct Upload</a></li>
                            <li role="presentation"><a href="#ftpUpload" aria-controls="ftpUpload" role="tab" data-toggle="tab">Via FTP</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="directUpload">
                                <br>
                                @include('admin.task._dropzonjs_upload')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="ftpUpload">

                                <blockquote>
                                    <p>you can upload on this job from ftp <br>
                                    Please login your FTP acount from FTP Client and upload file on "{{ $id->id }}" Folder</p>
                                </blockquote>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{--/Upload Images Modal--}}
        {!! Form::model($id,['action'=>['TaskController@update',$id->id], 'method'=>'PATCH','class'=>'form-horizontal', /*'files' => true*/]) !!}
        <h4 class="col-xs-12">JOB ID: {!! $id->id !!}</h4>
        @include('admin.task._task')
        {!! Form::close() !!}
        @if(array_key_exists('images', $withData) && count($withData['images'])>0)
            @include('admin.task._image_view')
        @endif
        <div class="clearfix"></div>
    </div>
</div>
@endsection
@section('style')
    <link rel="stylesheet" href="{!! asset('plugins/jQuery/colorbox.css') !!}">
@endsection
@push('footer_script')
    <script src="{{ asset('plugins/jQuery/jquery.colorbox-min.js') }}"></script>
    <script>
        $('a.light_box').colorbox({rel:'gal','maxWidth':'700px','title':function () {
            return $(this).parents('.row').children('h5.image-title').html()
        }});
    </script>
@endpush