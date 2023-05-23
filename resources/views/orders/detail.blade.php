@extends('layouts.appMain')
<!-- строки ордера на товары (в кабинете пользователя) -->
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
                                <li><a href="{{ '/account' }}">Edit profile </a></li>
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
                <h2>Order components</h2>
                <h3>Order #{{ $order->id }}</h3>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th width=2%>#</th>
                    <th width="50%">Title</th>
                    <th width="3%">Amount</th>
                    <th width="10%">Price for piece</th>
                    <th width="10%">Total for products</th>
                </thead>
                <tbody>
                    @foreach($orderparts as $index => $part )
                        <tr>
                            <td> {{ $index+1 }} </td>
                            <td> {{ $part->product->title }} </td>
                            <td> {{ $part->amount }} </td>
                            <td> &#8364;{{number_format($part->product->price,2)}} </td>
                            <td> &#8364;{{number_format($part->product->price*$part->amount,2)}} </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>&#8364;{{ number_format($part->order->totalPrice, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection