@extends('layouts.app')
<!-- adminpanel. Форма для ввода новой услуги -->
@section('content')

<div class="box-header with-border">
    <h3 class="box-title"><strong>Service manage - Add</strong></h3>
</div>

<div class="box-body">
    <div class="add">
        <a href="servicelist" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-backward"></i> Back</a>
    </div>
    <div class="container">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New Service Form -->
        <form action="{{ url('addservice')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Service Name -->
            <div class="form-group">
                <label for="service-name" class="col-sm-3 control-label">Service title</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="service-name" class="form-control" value="{{ old('title') }}" placeholder="Title">
                </div>
            </div>
            <!-- Service description -->
            <div class="form-group">
                <label for="service-description" class="col-sm-3 control-label">Service description</label>
                <div class="col-sm-6">
                    <textarea type="text" name="description" id="service-name" class="form-control" value="" placeholder="Description">{{ old('description') }}</textarea>
                </div>
            </div>
            <!-- Service price -->
            <div class="form-group">
                <label for="service-price" class="col-sm-3 control-label">Service price</label>
                <div class="col-sm-6">
                    <input type="number" step=".01" min="0" name="price" id="service-name" class="form-control" value="{{ old('price', 0) }}">
                </div>
            </div>
             <!-- Service warranty -->
             <div class="form-group">
                <label for="service-warranty" class="col-sm-3 control-label">Service warranty</label>
                <div class="col-sm-6">
                    <input type="number" step="1" min="0" name="warranty" id="service-name" class="form-control" value="{{ old('warranty', 0) }}">
                </div>
            </div>
            <!-- Add Service Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-btn fa-plus"></i> Add Service
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection