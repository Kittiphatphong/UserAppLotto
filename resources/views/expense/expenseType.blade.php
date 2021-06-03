@extends('layouts.newApp')
@section('title','Expense type')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">EXPENSE TYPE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Expenses</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('expense-type.index')}}" class="text-muted">Type</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Expenses type
                    <span class="d-block text-muted pt-2 font-size-sm">Expenses type list</span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('expense-type.create')}}" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
											<i class="fas fa-plus-square"></i>
												</svg>
                                                <!--end::Svg Icon-->
											</span>New type expense</a>
                <!--end::Button-->
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
                        <th>NAME</th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
                        <th>ACTION</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expense_type as $type)
                        <tr>
                            <td>{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->created_at}}</td>
                            <td>{{$type->updated_at}}</td>
                            <td><a href="{{route('expense-type.edit',$type->id)}}"><i class="far fa-edit"></i></a></td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
