@extends('layouts.newApp')
@section('title','Dream teller')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">DREAM TELLER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Dream teller</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('dream-teller.index')}}" class="text-muted">List</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Dream teller
                    <span class="d-block text-muted pt-2 font-size-sm">Dream teller list</span></h3>
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
                        <th>DIGIT</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dream_teller_list as $dream)
                        <tr>
                     <td>{{$dream->id}}</td>
                    <td>{{$dream->title}}</td>
                    <td>{{$dream->content}}</td>
                    <td>{{str_replace('"','',implode(',',$dream->recommend_digits))}}</td>
                    <td class="text-center"><img src="{{$dream->dreamTellerImages->first()->image}}" width="80px" class="rounded-pill"></td>
                    <td>
                        <div class="d-flex justify-content-start m-0">
                            <a href="{{route('dream-teller.edit',$dream->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
                            <form action="{{route('dream-teller.destroy',$dream->id)}}" method="post" class="delete_form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    <td>{{$dream->created_at}}</td>
                    <td>{{$dream->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
