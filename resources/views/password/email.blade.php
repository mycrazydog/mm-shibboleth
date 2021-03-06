@extends('auth')

@section('title', 'Password Reset Email')
@section('bodyClass', 'login-page')

@section('content')

        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default login-box">
                    <div class="login-logo">
                      <a href="../../index2.html"><b>MEDIA</b>MENTIONS</a>
                    </div><!-- /.login-logo -->
                    
                    <div class="panel-heading">
                        <h3 class="panel-title">Password Reset Link</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'Auth\PasswordController@postEmail']) !!}
                        <fieldset>

                            @if (session()->has('flash_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('flash_message') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <p>Enter your email and we will send you a link to reset your password.</p>

                            <!-- Email field -->
                            <div class="form-group has-feedback">
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>

                            <!-- Submit field -->
                            <div class="form-group">
                                {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn btn-lg btn-primary btn-block']) !!}
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection