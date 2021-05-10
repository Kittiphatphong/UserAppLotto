@extends('layouts.newApp')
@section('title','New Partner')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">PARTNER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Maps</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('google-map.index')}}" class="text-muted">Index</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')







    <div class="rounded container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200 pb-4">
                    <div class="card-title">
                        <h3 class="card-label">New Partner
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form action="{{isset($edit)?route('partner.update',$edit->id): route('partner.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <lable>Partner name</lable>
                    <input type="text" class="form-control" name="partner_name" placeholder="Enter partner name" value="{{isset($edit)?$edit->partner_name:''}}" required>
                        </div>
                        <div class="form-group">
                            <lable>Icon</lable>
                            <input type="file" class="form-control" name="icon" >
                            @isset($edit)
                                <div class="d-flex justify-content-center" >
                            <img src="{{$edit->icon}}" class="py-4">
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block" >SUBMIT</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
