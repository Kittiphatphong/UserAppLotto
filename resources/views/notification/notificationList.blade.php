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



                        <th>TYPE</th>
                        <th>TITLE</th>
                        <th>CONTENT</th>
                        <th>TO</th>

                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notification_list as $list)
                    <tr>

                        <td>{{$list->notifications->typeNotifications->name}}<img src="{{$list->notifications->typeNotifications->icon}}" width="30px" class="float-right"></td>
                    <td>{{$list->notifications->title}}</td>
                        <td>{{$list->notifications->body}}</td>
                        <td>{{$list->customers->phone}}</td>
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
