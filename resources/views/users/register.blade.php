@extends('layouts.appMain')
<!-- заполнение формы Register(регистрация пользователя) -->
@section('content')
<section><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        		<hr style="border: 1px solid orange;border-radius: 5px;">
    		</div>
			<div class="col-sm-4 col-sm-offset-4">
				<div class="signup-form" ><!--sign up form-->
					@if(session()->get('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
						</div>
					@endif
					@include('common.errors')
					
					<h2>New User Signup!</h2>
					<form action="{{ url('register') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
					
						<div class="form-group has-feedback">
							<input type="text" class="form-control" name="name" placeholder="Name" required>
							<span class="glyphicon glyphicon-user form-control-feedback"></span>								
						</div>

						<div class="form-group">
								<input type="text" name="address" id="address" class="form-control" value="" placeholder="Enter your address" required>
								<span class="glyphicon glyphicon-home form-control-feedback"></span>	
						</div>

						<div class="form-group">
								<input type="text" name="phone" id="phone" class="form-control" value="" placeholder="Enter your phone" required>
								<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
						</div>

						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Email" required>
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>								
						</div>

						<div class="form-group">
								<input type="file" name="image"  class="form-control" value="">  
								<span class="glyphicon glyphicon-picture form-control-feedback"></span>
						</div>

						<div class="form-group">
								<input type="password" name="password" id="password" class="form-control" value="" placeholder="Enter your password" required>
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>

						<div class="form-group has-feedback">
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" placeholder="Password confirmation" required>
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>

						<div class="col-xs-4 col-sm-offset-4">
							<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-check form-control-feedback"></i>Signup</button>
						</div>
						
					</form>
				</div><!--/sign up form-->
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        		<hr style="border: 1px solid orange;border-radius: 5px;">
    		</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        		<p>Already have an account? <a href="{{ url('/login') }}">Login</a>.</p>
    		</div>
		</div>
	</div>
</section><!--/form-->

@endsection