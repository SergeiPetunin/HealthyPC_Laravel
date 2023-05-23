@extends('layouts.app')

<!-- adminpanel. список всех категорий или по выбранной категории -->
<!-- удалить можно, если нет продукта с этой категорией-->

@section('content')

<!-- content categories list -->
<div class="box-title with-border">
    <h3 class="box-title"><strong> Categories manage</strong></h3>
    <div class="add">
        <a href="addcategory" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
    </div>
</div>

<div class="box-body">
    <table id="example1" class="table table-bordered">
        <thead>
            <th>Category Name</th>
            <th>Tools</th>
        </thead>
        
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <!-- форма отправит на маршрут удаления записи -->
                        <form action="{{ url('deletecategory/'.$category->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <!-- ссылка на маршрут редактирования -->
                            <a href="{{url('editcategory/'.$category->id)}}" title="edit" type="button" class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i> Edit </a>
                            <button type="submit" class='btn btn-danger btn-sm delete btn-flat'
                                @if(count($category->product) >0) 
                                    disabled="disabled" 
                                @endif
                                >
                                <i class="fa fa-trash"></i> Delete</button>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
