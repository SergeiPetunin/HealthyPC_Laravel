@extends('layouts.app')
<!-- adminpanel. Форма для формирования ордера на услуги из заявки -->

@section('content')

<div class="left-sidebar">
    <h2>Add service order</h2>
</div>

<div class="box-body">
    @include('common.errors')
    <form action="" method="POST">
        @csrf
        <div>
            @foreach ($servicerequestslist as $servicereq)
                <div class="flex-container">
                    <div>
                        ID:<input type="text" name="user_id" value="{{$servicereq->user_id}}" readonly>
                    </div>
                    <div>
                        Name:<input type="text" name="clientName" value="{{$servicereq->clientName}}" readonly>
                    </div>
                    <div>
                        Address:<input type="text" name="address" value="{{$servicereq->aadress}}" readonly>   
                    </div>
                    <div>
                        Phone:<input type="text" name="phone" value="{{$servicereq->phone}}" readonly>
                    </div>
                    <div>
                        Email:<input type="text" name="email" value="{{$servicereq->email}}" readonly>  
                    </div>
                </div>
                <div class="flex-container">
                    <div>
                        Problem description:<textarea style="resize: none;" type="text" name="" value="" readonly>{{$servicereq->description}}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
        @foreach ($services as $service)
            <div>
                <input type="text" value="{{$service->id}}" name="serviceID[{{$service->id}}]" hidden>
                <input type="checkbox" id="{{$service->id}}" name="service[{{$service->id}}]">
                <label for="{{$service->id}}">{{$service->title}}</label>
                <p>{{$service->description}}</p>
            </div>
        @endforeach

        <button type="submit">Add order</button>
    </form>
</div>

<style>
    .flex-container {
        display: flex;
        flex-direction: column;
        width: 300px; /* adjust as per your requirement */
        
    }
    .flex-container input {
        width: 100%; /* make the input take the full width of the parent div */
    }
</style>

@endsection