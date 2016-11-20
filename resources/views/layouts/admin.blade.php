<?php
/**quantity*/
?>

@extends('layouts.base')
@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('body_class') nav-md @endsection
@section('body')
    <div class="container body">
        <div class="main_container">
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <div class="col-md-3 left_col">
                @include('_partial.left_col')
            </div>

            <!-- top navigation -->
            <div class="top_nav hidden-print">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{!! asset('images/img.jpg') !!}" alt="">{!! auth()->user()? auth()->user()->name : 'John Doe' !!}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">{!! count(auth()->user()->notifications) !!}</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    @foreach(auth()->user()->notifications as $notification)

                                    <li>
                                        <a>
                                            <span class="image"><img src="{!! url('images/img.jpg') !!}" alt="Profile Image" /></span>
                                            <span>
                                              <span>{!! $notification->data['title'] or "" !!}</span>
                                              <span class="time">{!! $notification->created_at->diffForHumans() !!}</span>
                                            </span>
                                            <span class="message">
                                              Qty:{!! $notification->data['total_qty'] or "" !!}
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    @include('_partial.page_title',['isSearch'=>session('isSearch') || 1])

                    <div class="clearfix"></div>
                    @if($errors->all())
                        @include('_partial.error_print')
                        <div class="clearfix"></div>
                    @endif
                    @if(!empty(session()->has('message')))
                        @include('_partial.message_print')
                        <div class="clearfix"></div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <!-- /page content -->


            <!-- footer content -->
        @include('_partial.footer')
        <!-- /footer content -->

        </div>
    </div>
@endsection
@section('head')
    <link rel="stylesheet" href="{!! asset('vendors/sweetalert2/dist/sweetalert2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('vendors/select2/dist/css/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/admin_customize.css') !!}">
@endsection
@section('footer_script')
    <script src="{!! asset('vendors/sweetalert2/dist/sweetalert2.min.js') !!}"></script>
    <script src="{!! asset('vendors/select2/dist/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('js/panel.js') !!}"></script>

@endsection
@section('script_call')
    <script>
        $(document).ready(function () {
            $('[data-id^="deleted_form_"]').click(function () {
                var $me = $(this);
                function deleteFun() {
                    $me.parents('form#'+$me.data('id')).submit()
                }

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function() {
                    deleteFun();
                    swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                    );
                });
            });
        });
    </script>
@endsection