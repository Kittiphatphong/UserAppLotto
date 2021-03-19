@extends('layouts.newApp')
@section('title','Promotion List')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">PROMOTION PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Promotion</span>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('promotion.list')}}" class="text-muted">Promotion List</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Promotion
                    <span class="d-block text-muted pt-2 font-size-sm">Promotion list </span></h3>
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
                        <th>TITLE</th>
                        <th>CONTENT</th>
                        <th>IMAGE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($promotion_list as $promotion)
                        <tr>
                             <td>{{$promotion->id}}</td>
                            <td> {{$promotion->title}}</td>
                            <td>{{$promotion->content}}</td>
                            <td><img src="{{$promotion->image}}" width="80%" ></td>
                            <td>
                                @if(\Carbon\Carbon::now()->gt($promotion->end))<b class="text-danger far fa-dot-circle"> Inactive</b>
                                @elseif(\Carbon\Carbon::now()->lt($promotion->start))
                                    <b class="text-warning far fa-dot-circle"> Pending</b>
                                @else
                                    <b class="far fa-dot-circle p-1 rounded text-success"> Active</b><span class="text-success"> {{$promotion->differentTime()}}</span>
                                @endif
                            </td>
                            <td><div class="d-flex justify-content-start">
                                <a href="{{route('promotion.edit',$promotion->id)}}" class="btn btn-link"><i class="far fa-edit"></i></a>

                                <form action="{{route('promotion.delete',$promotion->id)}}" method="post" class="delete_form">
                                    @csrf
                                <button type="submit" class=" btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                </form>

                                    <form action="{{route('promotion.notification',$promotion->id)}}" method="post" class="push_form">
                                    @csrf
                                    <button type="submit"  class="btn btn-link"><i class="fas fa-arrow-alt-circle-up "></i></button>
                                </form>
                                </div>
                            </td>
                            <td>{{$promotion->start}}</td>
                            <td>{{$promotion->end}}</td>
                            <td>{{$promotion->updated_at}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>


@endsection
