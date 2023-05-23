@extends('layouts.appMain')
<!-- заполнение формы Login ( для входа в аккаунт зарегистрированных пользователей) -->
<!-- требования : e-mail и password-->
@section('content')

<section><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        		<hr style="border: 1px solid orange;border-radius: 5px;">
    		</div>
			<div class="col-sm-4 col-sm-offset-4">
				<div class="login-form"><!--login form-->
				
					@if(session()->get('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
						</div>
					@endif
					@include('common.errors')
					<h2>Login to your account</h2>
					<form action="" method="POST">
						@csrf
						<div class="form-group has-feedback">
							<input type="email" class="form-control" name="email" placeholder="Email" required>
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>								
						</div>
						<div class="form-group has-feedback">
							<input type="password" class="form-control" name="password" placeholder="Password" required>
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>			
						</div>
						<span class="col-xs-12 col-sm-offset-3">
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						
						<div class="col-xs-6 col-sm-offset-3">
							<button type="submit" class="btn btn-primary btn-block btn-flat" name="login">
							<i class="glyphicon glyphicon-log-in form-control-feedback"></i>Sign In</button>
						</div>
						
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        		<hr style="border: 1px solid orange;border-radius: 5px;">
    		</div>

			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        		<p>Don't have an account? <a href="{{ url('/register') }}">Register</a>.</p>
    		</div>
		</div>
	</div>
</section><!--/form-->

@endsection

