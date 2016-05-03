@extends('auth')

@section('title', 'Login')
@section('bodyClass', 'lockscreen')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            

                
                <div class="  lockscreen-wrapper">
                	
                	<div class="login-logo">
                	 <a href="{{ url('/manage/posts') }}"><img src="{{ asset ("/assets/img/uncc_crown.png") }}">                	
                	  <b>COMMUNITY</b>ENGAGEMENT</a>
                	</div><!-- /.login-logo -->               	

                	
                	<div class="lockscreen-footer text-center">
                	        Copyright © 2015 <b><a href="http://ui.uncc.edu" class="text-black">UNC Charlotte Urban Institute</a></b><br>
                	        All rights reserved
                	</div>
                

                    <div class="panel-body">

                    </div>
                </div>



            </div>
        </div>
    </div>

@endsection