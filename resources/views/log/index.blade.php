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
                        <th>LOG_NAME</th>
                        <th>DESCRIPTION</th>
                        <th>SUBJECT_TYPE</th>
                        <th>SUBJECT_ID</th>
                        <th>AUTH USER</th>
                        <th>CAUSER_TYPE</th>
                        <th>PROPERTIES</th>
                        <th>CRATED_AT</th>
                        <th>UPDATED_AT</th>
                    </tr>
                    </thead>
                    <tbody>
@foreach($log_index_customer as $log)
    <tr>
        <td>{{$log->id}}</td>
        <td>{{$log->log_name}}</td>
        <td>{{$log->description}}</td>
        <td>{{$log->subject_type}}</td>
        <td>{{$log->subject_id}}</td>
        <td>@if($log->causer_id==null)<span class="text-info">Customer</span> @else @if($log->causer == null)<span class="text-danger">User was deleted</span> @else{{$log->causer->name}}@endif  @endif</td>
        <td>{{$log->causer_type}}</td>
        <td>{{$log->changes}}</td>
        <td>{{$log->created_at}}</td>
        <td>{{$log->updated_at}}</td>
    </tr>
@endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
