@extends('layouts.appMain')
<!-- Форма ордера (для заполнения данных о пользователе), данные в строках формируются автоматически из корзины(cart) -->
<!-- Если это зарегистрированный пользователь, то автоматически заполняются его данные.Можно корректировать их. -->
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class=""><a href="/cart">Shopping Cart</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-5">
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<!-- Display Validation Errors -->
								@include('common.errors') 
								<form action="{{url('/addorder')}}" method="POST">
									{{ csrf_field() }}
									@if (Auth::guest())
										<input type="text" name="clientName" placeholder="Name" value="{{ old('clientName') }}">
										<input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
										<input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}">
										<input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
									@else
										<input type="text" name="clientName" value="{{Auth::user()->name}}">
										<input type="email" name="email" value="{{Auth::user()->email}}">
										<input type="text" name="phone" value="{{Auth::user()->phone}}">
										<input type="text" name="address" value="{{Auth::user()->address}}">
									@endif
									<button type="submit" class="btn btn-primary">Continue</button> 
									<input type="hidden" name="totalPrice" value="{{Cart::getTotal()}}">
									@foreach ($cartItems as $item)
										<p>
											<input type="hidden" value="{{ $item->id }}" name="product_id">
											<input type="hidden" value="{{ $item->quantity }}" name="amount">
										</p>
									@endforeach
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Title</td>
							<td class="price">Price</td>
							<td  class="quantity">Quantity</td>
							<td></td>
							<td class="total">Total</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach ($cartItems as $item)
							<tr>
								<td class="cart_product">
									<img style="width:50px" class="" src="../images/shop/{{ $item->attributes->image }}" alt="Thumbnail">
								</td>
								<td class="cart_description">
									<h4>{{ $item->name }}</h4>
								</td>
								<td class="cart_price">
									<p>&#8364;{{ number_format($item->price,2) }}</p>
								</td>
								
								<input type="hidden" name="id" value="{{ $item->id}}" >
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $item->quantity }}" readonly>
									</div>
								</td>
								<td></td>
								<td class="cart_price">
									<p>&#8364;{{ number_format($item->price*$item->quantity,2) }}</p>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"></p>
								</td>
								<td></td>
							</tr>
						@endforeach
						<tr>
							<table class="table table-condensed total-result">
								<div class="row">
									<div class="col-sm-6" style="margin-left:45%;">
										<div class="total_area">
											<ul>
												<li>Total <span>&#8364;{{ number_format(Cart::getTotal(),2) }}</span></li>
												<li>Shipping Cost <span>Free</span></li>
											</ul>
										</div>
									</div>
								</div>
							</table>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

@endsection