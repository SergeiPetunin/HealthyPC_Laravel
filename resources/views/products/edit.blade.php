@extends('layouts.app')
<!-- adminpanel. редактирование продукта -->

@section('content')

<!-- content products -->
<div class="box-header with-border">
    <h3 class="box-title"><strong> Product manage - Edit</strong></h3>
</div>
<div class="box-body">
	<div class="container">
		<div class="add">
			<a href="/productlist" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-backward"></i> Back</a>
		</div>
   
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- Product EditForm -->
        <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			<div class="form-group">
				<label for="title" class="col-sm-3 control-label">Title:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="title" value="{{ $product -> title }}" class="" placeholder="Title">
				</div>
			</div>
			
			<div class="form-group">
				<label for="category-name" class="col-sm-3 control-label">Categories:</label>
				<div class="col-sm-6">
					<select name="category_id" class="form-control" id="">															
						@foreach ($categories as $category)			
						<option value="{{$category->id}}" 
						@if ($category->id==$product->category_id)
						selected
						@endif
						>{{$category->name}}</option>						
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="price" class="col-sm-3 control-label">Price:</label>
				<div class="col-sm-6">
					<input type="text" name="price" class="form-control" placeholder="Price" value="{{ number_format($product -> price, 2) }}">
					
				</div>
			</div>
			<div class="form-group">
				<label for="warranty" class="col-sm-3 control-label">Warranty:</label>
				<div class="col-sm-6">
					<input type="number" name="warranty" step="1" min="0" class="form-control" placeholder="Warranty (months)" value="{{ $product -> warranty }}">
				</div>
			</div>
			
			<div class="form-group">
				<label for="description" class="col-sm-3 control-label">Description:</label>
				<div class="col-sm-6">
					<textarea class="form-control" type="text" name="description">{{ $product -> description }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="image" class="col-sm-3 control-label">Previous image</label>
				<div class="col-sm-6">
					@if(!empty($product -> image))
						<input type="text" name="oldpicture" placeholder='' class="form-control" value="{{$product -> image}}" readonly>
						<img width="300" height="300" src="../images/shop/{{ $product -> image }}" class="thumbnail">
					@else
						<input type="text" name="oldpicture" placeholder='' class="form-control" value="no image" readonly>
					@endif
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label">New image:</label>
				<div class="col-sm-6">
					<input type="file" name="image"  class="form-control" value=""> 
				</div>
			</div>
								
			<div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary form-control">Save product</button>
				</div>
			</div>
		</form>
    </div>
</div>

@endsection
<!--  -->