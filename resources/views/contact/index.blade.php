@extends('layouts.appMain')
<!-- mainSite. Заполнение формы Contact( заявка на обслуживание) -->
@section('content')

<div id="contact-page" class="container">
	<div class="bg">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="title text-center">Contact Us</h2>
				<div id="gmap" class="contact-map" style="text-align:center; margin-bottom:100px;">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3415.5777949674016!2d27.279920055261567!3d59.401135472812456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2see!4v1669298969633!5m2!1sru!2see" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<div class="contact-form">
					<h2 class="title text-center">Get In Touch</h2>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        @if (session('success'))
                            <div class="alert alert-warning">
                                <h4>{{ session('success') }}</h4>
                            </div>
                        @endif
                    </div>
					<div class="status alert alert-success" style="display: none"></div>
					@include('common.errors')
					<form id="main-contact-form" class="contact-form row" name="contact-form" action="{{url('/contact')}}" method="POST">
						{{ csrf_field() }}
						@if (Auth::guest())
							<div class="form-group col-md-6">
								<input type="text" name="clientName" class="form-control" required="required" placeholder="Name">
							</div>
							<div class="form-group col-md-6">
								<input type="email" name="email" class="form-control" required="required" placeholder="Email">
							</div>
							<div class="form-group col-md-6">
								<input type="text" name="phone" class="form-control" required="required" placeholder="Phone">
							</div>
							<div class="form-group col-md-6">
								<input type="aadress" name="aadress" class="form-control" required="required" placeholder="Address">
							</div>
						@else
							<div class="form-group col-md-6">
								<label for="clientName">Name:</label>
								<input type="text" name="clientName" id="clientName" class="form-control" required="required" value="{{Auth::user()->name}}">
							</div>
							<div class="form-group col-md-6">
								<label for="email">Email:</label>
								<input type="email" name="email" id="email" class="form-control" required="required" value="{{Auth::user()->email}}">
							</div>
							<div class="form-group col-md-6">
								<label for="phone">Phone:</label>
								<input type="text" name="phone" id="phone" class="form-control" required="required" value="{{Auth::user()->phone}}">
							</div>
							<div class="form-group col-md-6">
								<label for="aadress">Address:</label>
								<input type="aadress" name="aadress" id="aadress" class="form-control" required="required" value="{{Auth::user()->address}}">
							</div>
						@endif
						<div class="form-group col-md-12">
							<textarea name="description" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
						</div>
						<div class="form-group col-md-12">
							<input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="contact-info">
					<h2 class="title text-center">Contact Info</h2>
					<address>
						<p>Healthy PC</p>
						<p>Kalevi 16, 30322 Kohtla-Jarve</p>
						<p>Estonia</p>
						<p>Mobile: +372 55 33 44</p>
						<p>Email: healthy@hpc.ee</p>
					</address>
					<div class="social-networks">
						<h2 class="title text-center">Social Networking</h2>
						<ul>
							<li>
								<a href="https://www.facebook.com/" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a href="https://twitter.com" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a href="https://www.linkedin.com" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>
							</li>
							<li>
								<a href="https://www.instagram.com" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>
							</li>
							<li>
								<a href="https://plus.google.com/" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/#contact-page-->

@endsection
