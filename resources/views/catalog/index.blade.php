@extends('layouts.appMain')

<!-- Просмотр каталога товаров (все товары или по категориям), детальный просмотр товара, добавить товар в корзину -->
@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    @if (session('success'))
        <div class="alert alert-warning">
            <h2>{{ session('success') }}</h2>
        </div>
    @endif
</div>
<section>
    <div class="col-sm-10">
        <div class="pull-right">
            <form action="{{url('/search')}}" method="GET">
                <input type="text" name="search" placeholder="Search" required/>

                <button type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>

    </div>

</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <div class="panel panel-default">

                            <form action="" method="POST" >
                                @csrf
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="{{ '/catalog' }}">ALL </a></li>
                                        @foreach($categories as $category)
                                            <li><a href="{{ url('/categoryproducts/'.$category->id) }}">{{$category->name}} ({{ count($category->product) }})</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Features Items</h2>
                    @if(isset($search))
                        <div class="alert alert-warning text-center">
                            <h4>Search by "{{$search}}"</h4>
                        </div>
                    @endif

                    @foreach($products as $product)
                    <div class="col-sm-4">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    @csrf
                                    <div class="productinfo text-center">
                                        <img width = "300" height = "300" src="../images/shop/{{$product->image}}" alt="" class="product-image"/>
                                        <h2>${{$product->price}}</h2>
                                        <p>{{$product->title}}</p>

                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$product->price}}</h2>
                                            <p>{{$product->description}}</p>

                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $product->id }}" name="id">
                                <input type="hidden" value="{{ $product->title }}" name="name">
                                <input type="hidden" value="{{ $product->price }}" name="price">
                                <input type="hidden" value="{{ $product->image }}"  name="image">
                                <input type="hidden" value="1" name="quantity">

                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="{{url('show/'.$product->id)}}"><i class="fa fa-plus-square"></i>Details</a></li>
                                    </ul>
                                </div>

                            </div>
                        </form>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-sm-12" style="text-align: center;">
            
            <ul class="pagination">
                @if(isset($search))
                    {{ $products->appends(['search' => $search])->onEachSide(2)->links() }}
                @else
                    {{ $products->onEachSide(2)->links() }}
                @endif
            </ul>

        </div>
    </div>

</section>

@endsection
