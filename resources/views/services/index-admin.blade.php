@extends('layouts.app')
<!-- adminpanel. список услуг -->
<!-- удалить можно, если нет ещё ордера с этой услугой-->

@section('content')

<div class="box-header with-border">
    <h3 class="box-title"><strong> Service List manage</strong></h3>
    <div class="add">
        <a href="addservice" class="btn btn-primary btn-sm btn-sm"><i class="fa fa-plus"></i> New </a>
    </div>
</div>

<div class="box-body">
    <table id="example3" class="table table-bordered">
        <thead>
            <th width="15%">Service name</th>
            <th width="30%">Description</th>
            <th >Price</th>
            <th >Warranty</th>
            <th > Tools </th>
        </thead>

        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ number_format($service->price, 2) }}&#8364;</td>
                    <td>{{ $service->warranty }} months</td>
                    <td>
                        <a href="{{ url('editservice/'.$service -> id) }}" class="btn btn-success btn-sm edit btn-sm"><i class="fa fa-edit"></i> Edit </a>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteService{{ $service->id }}"
                            @if(count($service->orderservicepart) >0)
                                disabled="disabled"
                            @endif
                        ><i class='fa fa-trash'></i> Delete </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

        <!-- Modal -->
        @foreach ($services as $service)
            <div class="modal fade" id="deleteService{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="exampleModalLongTitle">Service: <b> {{ $service->title }} </b></h3>
                        </div>
                        <div class="modal-body">
                            <h4>Are you sure you want to remove this service?</h4>
                        </div>

                        <div class="modal-footer">
                            <div class="form-group row">
                                <div class="col-xs-6" style="text-align:left">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-xs-6">
                                    <form action="{{ url('deleteservice/'.$service->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </table>
</div>

@endsection
