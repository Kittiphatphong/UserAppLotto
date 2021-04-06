@extends('layouts.newApp')
@section('title','District')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">DISTRICT PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">District</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('district.index')}}"class="text-muted">List</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">District
                    <span class="d-block text-muted pt-2 font-size-sm">District list </span></h3>
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
                        <th>PROVINCE EN</th>
                        <th>PROVINCE LA</th>
                        <th>NAME LA</th>
                        <th>NAME EN</th>
                        <th>ACTION</th>


                    </tr>
                    </thead>
                    <tbody>
@foreach($district_index as $district)
    <tr>
        <td>{{$district->provinces->pr_name_en}}</td>
        <td>{{$district->provinces->pr_name}}</td>
        <td>{{$district->dr_name}}</td>
        <td>{{$district->dr_name_en}}</td>
        <td>
            <a href="{{route('district.edit',$district->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>

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
