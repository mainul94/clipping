<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 3:31 PM
 */
?>
<div class="page-title">
    <div class="title_left">
        @yield('page_title_left')
        {{--<h3>{!! $page_title or "" !!} <small>{!! $page_sub_title or "" !!}</small></h3>--}}
    </div>
    @if(!empty($isSearch))
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    @endif
</div>
