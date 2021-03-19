@extends('layouts.newApp')
@section('title','Animals')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">40 ANIMALS PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">40 Animals</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('animal.list')}}"class="text-muted">List</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">40 Animals
                    <span class="d-block text-muted pt-2 font-size-sm">Animal list </span></h3>
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
                        <th>NAME</th>
                        <th>ANIMAL DIGIT</th>
                        <th>IMAGE</th>
                        <th>DESCRIPTION</th>
                        <th>DIGIT</th>
                        <th>EDIT</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animal_list as $animal)
                        <tr>
                            <td>{{$animal->id}}</td>
                            <td>{{$animal->name}}</td>
                            <td>{{str_replace('"','',$animal->animalNos->pluck('animal_digit'))}}</td>
                            <td class="text-center"><img src="{{$animal->image}}" width="80px" ></td>
                            <td>{{$animal->description}}</td>
                            <td>@foreach($animal->digit as $digit) [{{$digit}}] @endforeach</td>
                            <td><a href="{{route('animal.edit',$animal->id)}}" class="btn btn-link"><i class="far fa-edit"></i></a></td>
                            <td>{{$animal->updated_at}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
