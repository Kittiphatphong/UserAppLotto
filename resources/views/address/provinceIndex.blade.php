@extends('layouts.newApp')
@section('title','Province')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">PROVINCE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Province</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('province.index')}}"class="text-muted">List</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Province
                    <span class="d-block text-muted pt-2 font-size-sm">Province list </span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>PROVINCE EN</th>
                        <th>PROVINCE LA</th>
                        <th>ACTION</th>


                    </tr>
                    </thead>
                    <tbody>
@foreach($province_index as $province)
    <tr>
        <td>{{$province->id}}</td>
        <td>{{$province->pr_name_en}}</td>
        <td>{{$province->pr_name}}</td>
        <td>
            <a href="{{route('province.edit',$province->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
            <a href="" class="label label-lg font-weight-bold label-light-primary label-inline">{{$province->districts->count()}}</a>
        </td>
    </tr>

@endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
