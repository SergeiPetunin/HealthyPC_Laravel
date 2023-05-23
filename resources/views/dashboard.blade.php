@extends('layouts.app')
<!-- переход на страницу adminpanel -->
@section('content')
<div class="container">
    <div class="box-header with-border">
        <h3 class="box-title"><storng> Dashboar Start page</strong><h3>
    </div>
    
    <hr>
    <div class="box-body" style="min-height:450px">
        Welcome dashboard page
        <div><br>
            @can('isAdmin')
                <div class="btn btn-warning btn-lg">
                    You have Admin Access
                </div>
            @elsecan('isManager')
                <div class="btn btn-success btn-lg">
                    You have Manager Access
                </div>
            @elsecan('isUser')
                <div class="btn btn-primary btn-lg">
                    You have User Access
                </div>
            @else
                <div class="btn btn-danger btn-lg">
                    You have not logged in
                </div>
            @endcan
        </div>
    </div>
</div> 
@endsection