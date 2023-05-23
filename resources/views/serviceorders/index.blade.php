@extends('layouts.appMain')
<!-- список ордеров на услуги в кабинете пользователя -->
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
                <h2>Service orders</h2>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th width=20%>Service order#</th>
                    <th width="20%">Service data</th>
                    <th width="20%">Total price</th>
                    <th width="20%"></th>
                </thead>
                <tbody>
                    @foreach($serviceorders as $serviceorder)
                        <tr>
                            <td>{{$serviceorder->id}} </td>
                            <td> {{$serviceorder->serviceData}} </td>
                            <td> &#8364;{{number_format($serviceorder->totalPrice,2)}} </td>
                            <td>
                                <a href="{{ 'serviceorderdetails/'.$serviceorder->id }}" style="color:orange;"><i class="fa fa-edit"></i>Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <div>
    </div>
</div>

@endsection