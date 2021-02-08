@extends('layouts.newApp')
@section('title','Notification icon')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">NOTIFICATION PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Notification</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('notification.type')}}" class="text-muted">Type</a>
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
                    <span class="d-block text-muted pt-2 font-size-sm">Notification type</span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="datatable datatable-bordered datatable-head-custom " id="kt_datatable">
                    <thead>
                    <tr>


                        <th>ID</th>
                        <th>NAME</th>
                        <th>IMAGE</th>
                        <th>COUNT</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notification_icon as $notification)
                        <tr>
                            <td>{{$notification->id}}</td>
                            <td>{{$notification->name}}</td>
                            <td><img src="{{$notification->icon}}" width="50px"></td>
                            <td></td>
                            <td><a href="{{route('notification.icon.edit',$notification->id)}}"><i class="menu-icon fas fa-pen-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
