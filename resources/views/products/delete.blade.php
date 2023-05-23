@extends('layouts.app')
<!-- adminpanel. форма для подтверждения об удалении продукта -->
@section('content')

<div class="box-header with-border">
	<h3 class="box-title"><strong> Products manage - Delete product</strong></h3>
	<div class="add">
		<a href="/productlist" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-backward"></i> Back to list</a>
	</div>
</div>

<div class="box-body">
	<div class="container">
        <div class="col-lg-9 margin-tb">
			<!-- @if ($errors->any())
				<div class="alert alert-danger">
					<strong>Error!</strong> 
					<ul>
						@foreach ($errors->all() as $error)
							<li></li>
						@endforeach
					</ul>
				</div>
			@endif -->
			<form action="" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Category:</strong>
																			
						@foreach ($categories as $category)
							@if($category->id == $product->category_id)					
							<input type="text" value="{{$category->name}}" readonly >
							@endif					
						@endforeach
						
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Title:</strong>
						<input type="text" name="title" value="{{ $product->title}}" class="form-control" placeholder="Title" readonly>
					</div>
				</div>	

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Price:</strong>
						<input type="text" name="price" value="{{ $product->price}}" class="form-control" placeholder="Price" readonly>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Warranty:</strong>
						<input type="text" name="warranty" value="{{ $product->warranty}}" class="form-control" placeholder="Warranty" readonly>
					</div>
				</div>	

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Description:</strong>
						<textarea class="form-control"  style="height:50px;resize: none;" name="description"
							placeholder="" readonly>{{ $product->description}}</textarea>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Image:</strong>
						@if(!empty($product -> image))
							<input type="text" name="picture" placeholder='' class="form-control" value="{{$product -> image}}" readonly>
							<img width="200" height="200" src="../images/shop/{{ $product -> image }}" class="thumbnail">
						@else
							<input type="text" name="picture" placeholder='' class="form-control" value="no image" readonly>
						@endif
					</div>
				</div>	

				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-danger">Delete product</button>
				</div>			
			</form>
		</div>
    </div>
</div>

@endsection