@extends('layouts.app')
<!-- adminpanel. список пользователей -->
@section('content')

<div class="box-body">
    <div class="box-title">
        <h3 class="box-title"><strong>User manage</strong></h3>
    </div>
    <div class="add">
        <a href="adduser" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"> New user</i></a>
    </div>

    <!-- форма список ролей фильтрации пользователей -->
    <div class="pull-right">
        <form class="form-inline" action="{{ url('userByRole') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Role: </label>
                <select class="form-control input-sm" name="role" onChange=submit();>
                    <option value="0">All</option>
                    @foreach($roles as $role)
                        <option value="{{$role}}"
                            @if(isset($selectRole) && $role==$selectRole)
                                selected
                            @endif
                        >{{$role}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    @if (count($users ?? '') > 0)
        <table class="table table-bordered">
            <thead>
                <th width=20%>Name#</th>
                <th width="20%">Emai</th>
                <th width="20%">Role</th>
                <th width="20%">Tools</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td> {{ $user->name }} </td>
                        <td> {{ $user->email }} </td>
                        <td> {{ $user->role }} </td>
                        <td>
                            <a href="{{ url('edituser/'.$user -> id) }}" class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i>Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Data no found</p>
    @endif

   <div class="container"></div>

</div>

@endsection