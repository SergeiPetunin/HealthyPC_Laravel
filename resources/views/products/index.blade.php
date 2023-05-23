@extends('layouts.app')
<!-- adminpanel. список всех продуктов или по выбранной категории  -->
@section('content')

<div class="box-header with-border">
    <h3 class="box-title"><strong> News List manage</strong></h3>
    <div class="add">
        <a href="addproduct" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New </a>
    </div>
    <!-- форма список категорий для фильтрации данных -->
    <div class="pull-right">
        <form class="form-inline" action="{{ url('productByCategory') }}" method="POST">
            @csrf
            <div class="form-group">
                <label> Category: </label>
                <select class="form-control input-sm" name="category_id" onChange=submit();>
                    <option value="0">All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                        @if(isset($selectCategory) && $category->id == $selectCategory) selected @endif
                        >{{ $category -> name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="box-body">
    @if (count($products ?? '') > 0)
        <table id="example2" class="table table-bordered">
            <thead>
                <th>N/#</th>
                <th>Category</th>
                <th>Title</th>
                <th>Price</th>
                <th>Warranty</th>
                <th>Date Update</th>
                <th width="16%">Tools</th>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td> {{ $product->id }} </td>
                        <td> {{ $product->category_id }} - {{ $product->category->name }}</td>
                        <td> {{ $product->title }} </td>
                        <td> {{ number_format($product->price, 2) }}&#8364;</td>
                        <td> {{ $product->warranty }} months</td>
                        <td> {{ $product->updated_at->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ url('editproduct/'.$product -> id) }}" class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i>Edit</a>

                            <a  class="btn btn-danger btn-sm edit btn-flat"
                                @if(count($product->orderpart) >0)
                                    disabled
                                @else
                                    href="{{ url('deleteproduct/'.$product -> id) }}"
                                @endif
                            ><i class="fa fa-edit"></i>Delete</a>

                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td colspan=6>
                            {{ $product -> description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Data no found</p>
    @endif
</div>

@endsection
