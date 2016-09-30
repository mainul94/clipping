<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 3/22/16
 * Time: 1:06 AM
 */
?>
@foreach($withData['images'] as $key=>$image)
    <div class="col-sm-4">
        <div class="col-xs-12 bg-gray-light">
            <div class="row">
                @if(file_exists(str_replace('/Original/thumbnail','/Done',$image)))
                    @php $have_done = 1 @endphp
                @else
                    @php $have_done = 0 @endphp
                @endif
                <div class="col-xs-{{ $have_done?6:12 }}">
                    <br>
                    <a class="light_box center-block" href="{!! str_replace('/thumbnail','/preview',url($image)) !!}">
                        <img class="img-responsive img-bordered" src="{!! asset($image)  !!}" alt="Image">
                    </a>
                    <a class="center-block" href="{!! str_replace('/thumbnail','',url($image)) !!}" download="{!! basename($image) !!}">
                        <i class="fa fa-download" title="Download"></i>
                    </a>
                </div>
                @if($have_done)
                <div class="col-xs-6">
                    <br>
                    <a class="light_box center-block" href="{!! str_replace('/Original/thumbnail','/Done/preview',url($image)) !!}">
                        <img class="img-responsive img-bordered" src="{!! str_replace('/Original','/Done',url($image))  !!}" alt="Image">
                    </a>
                    <a class="center-block" href="{!! str_replace('/Original/thumbnail','/Done',url($image)) !!}" download="{!! basename($image) !!}">
                        <i class="fa fa-download" title="Download"></i>
                    </a>
                </div>
                @endif
                <h5 class="col-xs-12 image-title text-center">{!! basename($image) !!}</h5>
            </div>
        </div>
    </div>
    @if(++$key %3 == 0)
        <div class="clearfix"></div>
    @endif
@endforeach