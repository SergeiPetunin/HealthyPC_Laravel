@extends('layouts.app')
<!-- adminpanel. редактирование услуги -->

@section('content')
<div class="box-header with-border">
    <h3 class="box-title"><strong>Service manage - Edit</strong></h3>
</div>

<div class="box-body">
    <div class="add">
        <a href="/servicelist" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-backward"></i> Back</a>
    </div>
    <div class="container">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- Service EditForm -->
        <form action="" method="POST" class="form-horizontal">
            @csrf

            <!-- Service Name -->
            <div class="form-group">
                <label for="service-name" class="col-sm-3 control-label">Service title</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="service-name" class="form-control" value="{{ $service->title }}" placeholder="Title">
                </div>
            </div>
            <!-- Service description -->
            <div class="form-group">
                <label for="service-description" class="col-sm-3 control-label">Service description</label>
                <div class="col-sm-6">
                    <textarea  type="text" name="description" id="service-name" class="form-control" value="" placeholder="Description">{{ $service->description }}</textarea>
                </div>
            </div>
            <!-- Service price -->
            <div class="form-group">
                <label for="service-price" class="col-sm-3 control-label">Service price</label>
                <div class="col-sm-6">
                    <input type="number" step=".01" min="0" name="price" id="service-name" class="form-control" value="{{ $service->price }}">
                </div>
            </div>
             <!-- Service warranty -->
             <div class="form-group">
                <label for="service-warranty" class="col-sm-3 control-label">Service warranty</label>
                <div class="col-sm-6">
                    <input type="number" step="1" min="0" name="warranty" id="service-name" class="form-control" value="{{ $service->warranty }}">
                </div>
            </div>


            <!-- Add Service Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-btn fa-plus"></i> Edit Service
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<style>

textarea {
    width:100%;
    /* height:20px; */
    transition-duration:0.5s;
} 
textarea:focus {
    height:300px;
}
</style>
@endsection