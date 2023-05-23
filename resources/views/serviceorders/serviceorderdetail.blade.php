@extends('layouts.app')
<!-- adminpanel. строки ордера на услуги -->

@section('content')

<div class="left-sidebar">
    <h2>Service order components</h2>
    <div class="add">
	    <a href="/adminserviceorders" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-backward"></i> Back to list</a>
	</div>
    <h3>Order #{{ $orderservice->id }}</h3>
</div>
<table class="table table-bordered">
    <thead>
        <th width=2%>#</th>
        <th width="50%">Title</th>
        <th width="10%" class="text-center">Price</th>
    </thead>
    <tbody>
        @foreach($orderserviceparts as $index => $part )
        <tr>
            <td> {{ $index+1 }} </td>
            <td> {{ $part->service->title }} </td>
            <td class="text-right"> {{number_format($part->service->price,2)}} &#8364;</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td class="text-right text-danger "><b>{{number_format($part->orderservice->totalPrice,2)}} &#8364;</b></td>
        </tr>
    </tbody>
</table>

@endsection