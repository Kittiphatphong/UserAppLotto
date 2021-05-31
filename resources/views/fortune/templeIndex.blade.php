@extends('layouts.newApp')
@section('title','Temple')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">TEMPLE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Fortune</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('temple.index')}}"class="text-muted">Temple</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Temple
                    <span class="d-block text-muted pt-2 font-size-sm">Temple list </span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route('temple.create')}}" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
											<i class="fas fa-synagogue"></i>
											</span>New Temple</a>

            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>AMOUNT</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
           @foreach($fortune_index as $temple)
    <tr>
        <td><img src="{{$temple->image}}" width="100px" class="border rounded"></td>
        <td>{{$temple->temple_name}}</td>
        <td>{{$temple->fortunes->count()}}</td>
        <td>
            <div class="d-flex justify-content-around">
                <form action="{{route('fortune.index')}}">
                    <input type="hidden" value="{{$temple->id}}" name="temple_id">
                    <button type="submit" class="btn btn-link"><i class="fa fa-eye"></i></button>
                </form>
                <a href="{{route('temple.edit',$temple->id)}}" class="btn btn-link"><i class="fa fa-edit"></i></a>
                <form action="{{route('fortune.create')}}">
                    <input type="hidden" value="{{$temple->id}}" name="temple_id">
                    <button type="submit" class="btn btn-link"><i class="fa fa-plus-square"></i></button>
                </form>

            </div>
        </td>
        <td>{{$temple->updated_at}}</td>
    </tr>
           @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
