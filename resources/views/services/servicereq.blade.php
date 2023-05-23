@extends('layouts.app')
<!-- adminpanel. список заявок на услуги -->

@section('content')

<div class="box-body">
    <table class="table table-bordered">
        <thead>
            <th>#</th>
            <th>User ID</th>
            <th >Client Name</th>
            <th >Address</th>
            <th > Phone </th>
            <th > Email </th>
            <th > Status </th>
        </thead>
        <tbody>
            @foreach ($servicerequestslist as $index=>$servicereq)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $servicereq->user_id }}</td>
                    <td>{{ $servicereq->clientName }}</td>
                    <td>{{ $servicereq->aadress }}</td>
                    <td>{{ $servicereq->phone }}</td>
                    <td>{{ $servicereq->email }}</td>
                    <td @if($servicereq->status == "0") style="color: red" @endif> @if($servicereq->status == "1") completed @else not completed @endif</td>
                    <td>
                        <a href="{{ url('addserviceorder/'.$servicereq -> id) }}" class="btn btn-success btn-sm edit btn-sm"><i class="fa fa-info-circle"></i> Add </a>
                    </td>
                </tr>
                <tr>
                    <th><strong>Description:</strong></th>
                    <td colspan=7> {{ $servicereq->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection