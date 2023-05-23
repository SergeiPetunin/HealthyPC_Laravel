@extends('layouts.appMain')
<!-- строки ордера на услуги (в кабинете пользователя) -->
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
                <h2>Service orders details</h2>
                <h3>Order #{{ $id }}</h3>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th width=2%>#</th>
                    <th width="10%">Title</th>
                    <th width="10%">Service price</th>
                </thead>
                <tbody>
                    @foreach($orderserviceparts as $index => $orderservicepart )
                        <tr>
                            <td> {{ $index+1 }} </td>
                            <td> {{ $orderservicepart->service->title }} </td>
                            <td> &#8364;{{ number_format($orderservicepart->service->price,2) }} </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td> &#8364;{{ number_format($orderservicepart->orderservice->totalPrice,2) }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection