@extends('layouts.appMain')
<!--   аккаунт (доступно для аутентифицировавшегося пользователя) -->
<!-- редактирование профиля, просмотр истории ордеров на услуги и товары -->
@section('content')
<section>
<!-- <div class="container" id="form"> -->
<div class="container">
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

        <div class="col-sm-9 padding-right">

            <div class="features_items">
                <h2 class="title text-center">Profile</h2>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    @if (session('success'))
                        <div class="alert alert-warning">
                            <h4>{{ session('success') }}</h4>
                        </div>
                    @endif
                </div>
                @include('common.errors')
                <!-- Category EditForm -->
                <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name: </label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Enter your name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address: </label>
                        <div class="col-sm-6">
                            <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}" placeholder="Enter your address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Phone: </label>
                        <div class="col-sm-6">
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" placeholder="Enter your phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email: </label>
                        <div class="col-sm-6">
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Enter your email"  readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Previous image: </label>
                        <div class="col-sm-6">
                            <input type="text" name="oldpicture" placeholder='oldPicture' class="form-control" value="{{$user -> image}}" readonly>
                            <img src="../images/avatar/{{ $user -> image }}" class="col-sm-6">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Image: </label>
                        <div class="col-sm-6">
                            <input type="file" name="image"  class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="password" id="password" class="form-control" value="" placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" placeholder="Password confirmation">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-bottom: 1em;">
                        <button type="submit" class="btn btn-primary">Save user</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
