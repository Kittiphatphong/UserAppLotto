@extends('layouts.newApp')
@section('title','Result')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">TERM AND CONDITION PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('term-condition.index')}}" class="text-muted">Term and condition</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Term and condition
                    <span class="d-block text-muted pt-2 font-size-sm">Term and condition </span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar d-flex justify-content-center">

                <!--begin::Button-->

            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>ID TERM</th>
                        <th>TITLE</th>
                        <th>CONTENT</th>
                        <th>ACTION</th>
                        <th>CREATED_AT</th>
                        <th>UPDATED_AT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($term_index as $term)
                        <tr>
                            <td>{{$term->id}}</td>
                            <td>{{$term->title}}</td>
                            <td>{{$term->content}}</td>
                            <td><div class="d-flex justify-content-start m-0">


                                    <a href="{{route('term-condition.edit',$term->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>

                                </div>
                            </td>
                            <td>{{$term->created_at}}</td>
                            <td>{{$term->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
