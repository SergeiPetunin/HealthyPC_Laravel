@extends('layouts.app')
<!-- adminpanel. список ордеров на услуги -->
@section('content')

<div class="box-header with-border">
    <h3 class="box-title"><strong> Service Ordes List manage</strong></h3>
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
            @foreach ($serviceorders as $sorder)
                <tr>
                    <td>{{ $sorder->id }}</td>
                    <td>{{ $sorder->serviceData }}</td>
                    <td>{{ number_format($sorder->totalPrice, 2) }}&#8364;</td>
                    <td>{{ $sorder->clientName }}</td>
                    <td>{{ $sorder->phone }}</td>
                    <td>{{ $sorder->email }}</td>
                    <td>
                        <a href="{{ url('adminserviceorderdetails/'.$sorder -> id) }}" class="btn btn-success btn-sm edit btn-sm"><i class="fa fa-info-circle"></i> Details </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection