@extends('layouts.appMain')
<!-- Просмотр детальной информации по выбранному продукту, просмотр отзывов о продукте,
	зарегистрированний пользователь может оставить свой отзыв -->
@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-products-->
						<div class="panel panel-default">
							<form action="" method="POST" >
								@csrf
								<div class="panel-body">
									<ul>
										<li><a href="{{ '/catalog' }}">ALL </a></li>
										@foreach($categories as $category)
											<li><a href="{{ url('/categoryproducts/'.$category->id) }}">{{$category->name}} ({{ count($category->product) }})</a></li>
										@endforeach
									</ul>
								</div>
							</form>
						</div>
					</div><!--/category-products-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<h2 class="title text-center">Item detail</h2>
				<div class="product-details">
					<div class="col-sm-5">
						<div class="view-product">
							<img src="../images/shop/{{$product->image}}" alt="" class="product-image"/>
							<h3>ZOOM</h3>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="product-information">
							<h2>{{$product->title}}</h2>
							<span>
								<span>${{$product->price}}</span>
								<form action="{{ route('cart.store') }}" method="POST" >
									@csrf
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									<input type="hidden" value="{{ $product->id }}" name="id">
									<input type="hidden" value="{{ $product->title }}" name="name">
									<input type="hidden" value="{{ $product->price }}" name="price">
									<input type="hidden" value="{{ $product->image }}"  name="image">
									<input type="hidden" value="1" name="quantity">
								</form>
							</span>
							<a href=""><img src="dist/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
						</div>
					</div>
				</div>

				<div class="category-tab shop-details-tab">
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
							<li><a href="#reviews" data-toggle="tab">Reviews ({{count($product->rewiews)}})</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="details" >
							<div class="col-sm-12">
								<div class="single-products">
									<div class="productinfo text-center">
										<p>{{$product->description}}</p>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="reviews" >
							<div class="col-sm-12">
								@if(Auth::check())
									<p><b>Write Your Review</b></p>
									@include('common.errors')
									<form action="{{url('rewiews')}}" method="POST">
										{{csrf_field()}}
										<textarea name="body" placeholder="Enter your text" required></textarea>
										<input type="hidden" name="productid" value="{{ $product->id }}" class="form-comtrol" placeholder="productId" readonly>
										<button type="submit" class="btn btn-default pull-right">
											Send rewie
										</button>
									</form>
									<div class="col-xs-12 col-sm-12 col-md-12 text-center">
										<hr style="border: 1px solid orange;border-radius: 5px;">
									</div>
								@endif
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
								<h4>Rewie List</h4>
								@forelse ($rewiews as $rewie)
									<ul>
										<li><a href=""><i class="fa fa-user"></i>{{ $rewie->user->name}}</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>{{date('h:i:sa',strtotime($rewie->created_at))}}</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>{{date('d-m-Y', strtotime($rewie->created_at))}}</a></li>
									</ul>
									<p>{{ $rewie->body}}</p>
								@empty
									<p>This post has no rewiews</p>
								@endforelse
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
