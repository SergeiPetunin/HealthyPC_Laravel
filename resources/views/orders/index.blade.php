@extends('layouts.appMain')
<!-- список ордеров на товары в кабинете пользователя -->
@section('content')

<div class="container" id="form">
    <div class="row">
        
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Account manage</h2>

                <div class="panel-group category-products" id="accordian">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul>
                                <li><a href="{{ '/account/'.Auth::user()->id }}">Edit profile </a></li>
                                <li><a href="{{ '/orders' }}">Orders</a></li>
                                <li><a href="{{ '/serviceorders' }}">Service orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="col-sm-9">
            <div class="left-sidebar">
                <h2>Orders</h2>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th width=20%>Order ID#</th>
                    <th width="20%">Order data</th>
                    <th width="20%">Total price</th>
                    <th width="20%"></th>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td> {{$order->id}} </td>
                            <td> {{$order->orderData}} </td>
                            <td> &#8364;{{number_format($order->totalPrice,2)}} </td>
                            <td>
                                <a href="{{ '/orderdetails/'.$order->id }}" style="color:orange;"><i class="fa fa-edit"></i>Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endsection