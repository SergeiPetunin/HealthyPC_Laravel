@extends('layouts.app')
<!-- adminpanel. ввод новой категории -->

@section('content')

<div class="box-header with-border">
    <h3 class="box-title"><strong>Categories manage - Add</strong></h3>
</div>
<div class="box-body">
    <div class="add">
        <a href="categorylist" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-backward"></i> Back</a>
    </div>
    <div class="container">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New Category Form -->
        <form action="{{ url('addcategory')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Category Name -->
            <div class="form-group">
                <label for="category-name" class="col-sm-3 control-label">Category</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control" value="">
                </div>
            </div>

            <!-- Add Category Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i> Add Category
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection