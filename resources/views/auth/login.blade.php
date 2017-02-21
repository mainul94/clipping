@extends('layouts.base')
@section('title')Login @endsection
@section('body_class')login @endsection
@section('head')
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">
@endsection
@section('body')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">

                    <div class="row"> <div class="col-sm-6 col-sm-offset-3"><img src="{{ asset('images/logo-01-300x200.png')  }}" alt="Clipping Associats" class="img-responsive"></div></div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="clearfix"></div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-info">
                                <p>
                                    {{ $message }}
                                </p>
                            </div>
                        @endif
                        @if ($message = Session::get('warning'))
                            <div class="alert alert-warning">
                                <p>
                                    {{ $message }}
                                </p>
                            </div>
                        @endif
                        <h1>Sign In</h1>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-info btn-small submit col-xs-12">Sign In</button>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a class="reset_pass" href="{{ url('/password/reset') }}">Lost your password?</a>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Don't have an account?
                                <a href="{{ url('/register') }}" class="to_register"> Sign Up </a>
                            </p>

                            <div class="clearfix"></div>

                            @include('_partial.copyright')
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection