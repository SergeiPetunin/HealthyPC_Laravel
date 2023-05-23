@extends('layouts.appMain')

<!-- Просмотр и редактирование корзины(cart) -->
<!-- Можно очистить всю корзину, удалить строку, исправить количество товара-->
<!-- Check out - сформировать ордер из корзины -->
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			@if ($message = Session::get('success'))
				<div class="p-4 mb-3 bg-green-400 rounded">
					<p class="text-green-800">{{ $message }}</p>
				</div>
			@endif
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Title</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
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
									<a href=""><img style="width:50px" class="" src="../images/shop/{{ $item->attributes->image }}" alt="Thumbnail"></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{ $item->name }} {{ $item->id }}</a></h4>
								</td>
								<td class="cart_price">
									<p>&#8364;{{ number_format($item->price,2) }}</p>
								</td>
								<form action="{{ route('cart.update') }}" method="POST">
									@csrf
									<input type="hidden" name="id" value="{{ $item->id}}" >
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<!-- <a class="cart_quantity_up" href=""> + </a> -->
												<input class="cart_quantity_input" type="number" name="quantity" value="{{ $item->quantity }}" autocomplete="off" size="2">
											<!-- <a class="cart_quantity_down" href=""> - </a> -->
										</div>
									</td>
									<td>
										<div class="px-4">
											<button type="submit" class="btn btn-warning px-2 pb-2 ml-2 text-white bg-blue-500">Update</button>
										</div>
									</td>
									<td class="cart_price">
										<p>&#8364;{{ number_format($item->price*$item->quantity,2) }}</p>
									</td>
								</form>
								<td class="cart_total">
									<p class="cart_total_price"></p>
								</td>
								<form action="{{ route('cart.remove') }}" method="POST">
									@csrf
									<td class="cart_delete">
										<input type="hidden" value="{{ $item->id }}" name="id">
										<!-- <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a> -->
										<button class="btn btn-warning"><i class="fa fa-times"></i></button>
									</td>
								</form>
								<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6" style="margin-left:30%;">
					<div class="total_area">
						<ul>
							<li>Total <span>&#8364;{{ number_format(Cart::getTotal(),2) }}</span></li>
							<li>Shipping Cost <span>Free</span></li>

                            <br>
                            <a class="btn btn-warning" style="margin: 0 auto; display: block;" href="{{url('/checkout')}}"
							@if (Cart::getTotalQuantity() == 0)
								disabled="disabled"
							@endif
						>Check Out</a>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection
