<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Healthy PC</title>
    <link href='{{ asset("dist/css/bootstrap.min.css") }}' rel="stylesheet">
    <link href='{{ asset("dist/css/font-awesome.min.css")}}' rel="stylesheet">
    <link href='{{ asset("dist/css/prettyPhoto.css")}}' rel="stylesheet">
    <link href='{{ asset("dist/css/price-range.css")}}' rel="stylesheet">
    <link href='{{ asset("dist/css/animate.css")}}' rel="stylesheet">
	<link href='{{ asset("dist/css/main.css")}}' rel="stylesheet">
	<link href='{{ asset("dist/css/responsive.css")}}' rel="stylesheet">
	<!-- Custom style -->
	<link rel="stylesheet" href='{{ asset("dist/css/custom_style.css") }}'>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href='{{ asset("dist/images/ico/favicon.ico") }}'>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href='{{ asset("dist/images/ico/apple-touch-icon-144-precomposed.png") }}'>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href='{{ asset("dist/images/ico/apple-touch-icon-114-precomposed.png") }}'>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href='{{ asset("dist/images/ico/apple-touch-icon-72-precomposed.png") }}'>
    <link rel="apple-touch-icon-precomposed" href='{{ asset("dist/images/ico/apple-touch-icon-57-precomposed.png") }}'>

</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +372 55 33 44</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> healthy@hpc.ee</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>

								<li><a href="https://twitter.com" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>

								<li><a href="https://www.linkedin.com" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>

								<li><a href="https://www.instagram.com" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>

								<li><a href="https://plus.google.com/" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ url('/') }}"><img src="/dist/images/home/logo.png" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li> -->
								<li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart ({{ Cart::getTotalQuantity()}})</a></li>
								@if (Auth::guest())
									<li><a href="{{ url('/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                                	<li><a href="{{ url('/register') }}"><i class="fa fa-lock"></i> Register</a></li>
								@else
									<li><a href="{{ url('/account/'.Auth::user()->id) }}"><i class="fa fa-user"></i> Account</a></li>

									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
										{{ strtoupper(Auth::user()->name) }} <span class="caret"></span>
										</a>

										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
										</ul>
									</li>

								@endif

								@if (!Auth::guest() && (Auth::user()->role == 'admin' || Auth::user()->role == 'manager'))
									<li><a href="{{ url('/dashboard') }}" class="navbar-brand">Admin panel</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/" class="{{ Request::path() == '/' ? 'active' : '' }}">Home</a></li>
								<li><a href="{{ url('/services') }}" class="{{ Request::path() == 'services' ? 'active' : '' }}">Services</a></li>
								<li><a href="{{ url('/catalog') }}" class="{{ Request::path() == 'catalog' || Request::is('categoryproducts/*') || Request::path() == 'search' || Request::is('search/*')? 'active' : '' }}">Catalog</a></li>
								<li><a href="{{ url('/contact') }}" class="{{ Request::path() == 'contact' ? 'active' : '' }}">Contact</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<!-- Main content -->
    <section class="content">
        <div class="row">
          	<!------------------CONTENT--------------------->
          	<div class="row">
				<div class="col-xs-12">
					<div class="content">

						@yield('content')

					</div>
				</div>
          	</div>
        </div>
    </section>

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2>Healthy<span> PC</span></h2>
							<p>Our company offers the services of a PC repair center.</p>
						</div>
					</div>

					<div class="col-sm-7">
					</div>

					<div class="col-sm-3">
						<div class="address">
							<img src="dist/images/home/map.png" alt="" />
							<p>Kalevi 16, 30322 Kohtla-Jarve, Estonia</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">HealthyPC 2023  (Educational project)</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->

    <script src='{{ asset("dist/js/jquery.js") }}'></script>

	<script src='{{ asset("dist/js/bootstrap.min.js") }}'></script>
	<script src='{{ asset("dist/js/jquery.scrollUp.min.js") }}'></script>
	<script src='{{ asset("dist/js/price-range.js") }}'></script>
    <script src='{{ asset("dist/js/jquery.prettyPhoto.js") }}'></script>
    <script src='{{ asset("dist/js/main.js") }}'></script>
	<script src='{{ asset("dist/js/jquery-3.6.3.min.js") }}'></script>

</body>
</html>
