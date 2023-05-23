@extends('layouts.app')
<!-- adminpanel. строки ордера на товары -->

@section('content')

<div class="left-sidebar">
    
    <h2>Order components</h2>
    <div class="add">
	    <a href="/orderlist" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-backward"></i> Back to list</a>
	</div>
    <h3>Order #{{ $order->id }}</h3>
</div>
<table class="table table-bordered">
    <thead>
        <th width=2%>#</th>
        <th width="50%">Title</th>
        <th width="3%">Amount</th>
        <th width="10%" class="text-center">Price for piece</th>
        <th width="10%" class="text-center">Total for products</th>
    </thead>
    <tbody>
        @foreach($orderparts as $index => $part )
        <tr>
            <td> {{ $index+1 }} </td>
            <td> {{ $part->product->title }} </td>
            <td class="text-right"> {{ $part->amount }} </td>
            <td class="text-right"> {{number_format($part->product->price,2)}} &#8364; </td>
            <td class="text-right"> {{number_format($part->product->price*$part->amount,2)}} &#8364; </td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right text-danger "><b>{{number_format($part->order->totalPrice,2)}} &#8364;</b></td>
        </tr>
    </tbody>
</table>

@endsection