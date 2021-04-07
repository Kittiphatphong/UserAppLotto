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
            <div class="mb-15 border rounded p-3">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col1" data-column="0">
                        <label>PROVINCE EN:</label>
                        <input type="text" class="column_filter form-control" id="col0_filter" placeholder="Search province en" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col2" data-column="1">
                        <label>PROVINCE LA:</label>
                        <input type="text" class="column_filter form-control" id="col1_filter" placeholder="Search province la" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col3" data-column="2">
                        <label>DISTRICT LA:</label>
                        <input type="text" class="column_filter form-control" id="col2_filter" placeholder="Search district la" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col4" data-column="3">
                        <label>DISTRICT EN:</label>
                        <input type="text" class="column_filter form-control" id="col3_filter" placeholder="Search district en" />
                    </div>


                </div>



            </div>
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>PROVINCE EN</th>
                        <th>PROVINCE LA</th>
                        <th>DISTRICT LA</th>
                        <th>DISTRICT EN</th>
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
