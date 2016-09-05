<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 7:03 PM
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-success">Messages !</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(array_key_exists('type', session('message')))
                    <div class="alert alert-{{ session('message')['type'] }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4>{!! session('message')['msg'] !!}</h4>
                    </div>
                    @else
                    @foreach(session('message') as $message)
                        <div class="alert alert-{{ $message['type'] }} alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4>{!! $message['msg'] !!}</h4>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
