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


                        <th>NAME</th>
                        <th>ANIMAL DIGIT</th>
                        <th>IMAGE</th>
                        <th>DESCRIPTION</th>
                        <th>DIGIT</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animal_list as $animal)
                        <tr>
                            <td>{{$animal->name}}</td>
                            <td>{{str_replace('"','',$animal->animalNos->pluck('animal_digit'))}}</td>
                            <td><img src="{{$animal->image}}" width="80%" ></td>
                            <td>{{$animal->description}}</td>
                            <td>@foreach($animal->digit as $digit) [{{$digit}}] @endforeach</td>
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
