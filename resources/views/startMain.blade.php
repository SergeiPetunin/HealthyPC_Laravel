@extends('layouts.appMain')

@section('content')

<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1>Healthy<span> PC</span></h1>
									<h2>Free IT-consultations</h2>
									<p>Remote assistance 24/7 - Supply of equipment and software</p>
									<button  type="button" class="btn btn-default get"><a href="services" style="all: unset;">Get it now</a></button>
								</div>
								<div class="col-sm-6">
									<img src="dist/images/home/tehnik2.jpg" class="girl img-responsive" alt="" style="margin-left: 100px"/>
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1>Healthy<span> PC</span></h1>
									<h2>Two years warranty</h2>
									<p>Our service provides a 2-year warranty for the services rendered.</p>
									<button  type="button" class="btn btn-default get"><a href="services" style="all: unset;">Get it now</a></button>
								</div>
								<div class="col-sm-6">
									<img src="dist/images/home/tehnik.jpg" class="girl img-responsive" alt="" style="margin-left: 100px"/>
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1>Healthy<span> PC</span></h1>
									<h2>Good prices for accessories</h2>
									<p>A wide range of processors, video cards, RAM, motherboards</p>
									<button  type="button" class="btn btn-default get"><a href="services" style="all: unset;">Get it now</a></button>
								</div>
								<div class="col-sm-6">
									<img src="dist/images/home/tehnik3.jpg" class="girl img-responsive" alt="" style="margin-left: 100px"/>
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->

    <section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<div style="text-align:center;margin-bottom:100px;">
							<h2 class="title text-center">About Us</h2>
							<p>
								Our company offers the services of a PC repair center.
								You can also buy the latest components from leading manufacturers from us.
							</p>
							<p>
							<p>You will have at your disposal not one specialist, but a whole team of trained
								professionals who are certified in accordance with high standards and are always ready to help.</p>
							</p>

							<div style="text-align:center;">
								<h2>How we are working?</h2>
								<p>Contact us via the form or by phone. Specify the reason for the failure</p>
							</div>

							<button  type="button" class="btn btn-default get"><a href="contact" style="all: unset;">Contact</a></button>
							
						</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>

@endsection