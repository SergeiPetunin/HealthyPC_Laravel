@extends('layouts.appMain')
<!-- mainSite. Список услуг -->
@section('content')

<div class="col-sm-12" style="text-align:center;">
    <div class="features_items"><!--features_items-->
        <div class="container">
            <h2 class="title text-center">Services</h2>

            <table id="example3" class="table table-bordered">
                <thead>
                    <th width="15%">Service name</th>
                    <th width="60%">Description</th>
                    <th >Price</th>
                    <th >Warranty</th>
                    
                </thead>
        
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{{ number_format($service->price, 2) }}&#8364;</td>
                            <td>{{ $service->warranty }} months</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--features_items-->

    <div class="col-sm-12" style="margin-bottom:100px;">
        <button type="button" class="btn btn-default get"><a href="contact" style="all:unset;text-align:center;">Contact</a></button>
    </div>
</div>

@endsection