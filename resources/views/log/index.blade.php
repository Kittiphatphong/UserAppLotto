@extends('layouts.newApp')
@section('title','Log')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">LOG PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Log</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('log.index')}}" class="text-muted">Index</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Log
                    <span class="d-block text-muted pt-2 font-size-sm">Log index</span></h3>
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
                        <th>TYPE</th>
                        <th>TITLE</th>
                        <th>CONTENT</th>
                        <th>TO</th>
                        <th>STATUS</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>
{{$log_index}}
@endsection
