@extends('layouts.newApp')
@section('title','Notification transaction')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">NOTIFICATION PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Notification transaction</span>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('notification.list')}}" class="text-muted">List</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Notification
                    <span class="d-block text-muted pt-2 font-size-sm">Notification list</span></h3>
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
                    @foreach($notification_list as $list)
                    <tr>
<td>{{$list->id}}</td>
                        <td><div class="d-flex justify-content-start"><p>{{$list->notifications->typeNotifications->name}}</p><img src="{{$list->notifications->typeNotifications->icon}}" width="35px" height="35px"></div></td>
                    <td>{{$list->notifications->title}}</td>
                        <td>{{$list->notifications->body}}</td>
                        <td>{{$list->customers->phone}}</td>
                        <td class="text-center">

                            @if($list->read_status == true)<span class="label label-lg font-weight-bold label-light-success label-inline ">Read</span>
                            @else<span class="label label-lg font-weight-bold label-light-warning label-inline ">Not yet</span>
                            @endif
                        </td>
                        <td>{{$list->updated_at}}</td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
