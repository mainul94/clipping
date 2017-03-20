@extends('layouts.base')
@section('title')Password Reset Link @endsection
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
                    <div class="row"> <div class="col-sm-6 col-sm-offset-3"><img src="{{ get_company_logo()  }}" alt="Clipping Associats" class="img-responsive"></div></div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <h1>Password Reset</h1>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="btn btn-default btn-small submit"><i class="fa fa-btn fa-envelope"></i> Send Password Reset Link</button>
                        </div>

                        <div class="clearfix"><br></div>

                        <div class="separator">
                            @include('_partial.copyright')
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection