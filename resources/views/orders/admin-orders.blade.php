@extends('layouts.app')
<!-- adminpanel. список ордеров на товары -->

@section('content')

<div class="box-header with-border">
    <h3 class="box-title"><strong> Order List manage</strong></h3>
</div>

<div class="box-body">
    <table class="table table-bordered">
        <thead>
            <th width="10%">Order ID#</th>
            <th width="10%">Order data</th>
            <th width="10%" >Total price</th>
            <th width="15%">Client Name</th>
            <th width="10%">Phone</th>
            <th width="10%">Email</th>
            <th width="10%"></th>
        </thead>

        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->orderData }}</td>
                    <td>{{ number_format($order->totalPrice, 2) }}&#8364;</td>
                    <td>{{ $order->clientName }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>
                        <a href="{{ url('admindetails/'.$order -> id) }}" class="btn btn-success btn-sm edit btn-sm"><i class="fa fa-info-circle"></i> Details </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection