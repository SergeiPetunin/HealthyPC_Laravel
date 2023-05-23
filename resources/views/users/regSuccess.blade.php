@extends('layouts.appMain')
<!-- выдаём сообщение об успешной регистрации -->
@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <p>Registration successful, please <a href="{{ url('/login') }}">login</a>.</p>
</div>

@endsection
