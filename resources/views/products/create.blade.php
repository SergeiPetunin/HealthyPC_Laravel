@extends('layouts.app')
<!-- adminpanel. Форма для ввода нового продукта -->

@section('content')

<div class="box-header with-border">
	<h3 class="box-title"><strong> Products manage - Add</strong></h3>
	<div class="add">
		<a href="productlist" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-backward"></i> Back to list</a>
	</div>
</div>

<div class="box-body">
	<div class="container">
        <div class="col-lg-9 margin-tb">
			@include('common.errors')
			<!-- New Products Form -->
			<form action="" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Category:</strong>
						<select name="category_id" class="form-control" >															
							@foreach ($categories as $category) 						
								<option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>{{$category->name}}</option>						
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Title:</strong>
						<input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
					</div>
				</div>	

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Price:</strong>
						<input type="number" name="price" step=".01" min="0" class="form-control" placeholder="Price" value="{{ old('price') }}">
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Warranty:</strong>
						<input type="number" name="warranty" step="1" min="0" class="form-control" placeholder="Warranty (months)" value="{{ old('warranty') }}">
					</div>
				</div>	

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Description:</strong>
						<textarea type="text" class="form-control"  name="description"
							placeholder="Description" >{{ old('description') }}</textarea>
					</div>
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Image:</strong>
						<input type="file" name="image"  class="form-control" >  
					</div>
				</div>	

				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Save product</button>
				</div>			
			</form>
		</div>
    </div>
</div>

@endsection