@extends('layouts.newApp')
@section('title','Background app')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">BACKGROUND APP PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Background app</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('image-app.create')}}" class="text-muted">create</a>
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
                        <h3 class="card-label">Background app
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form action="{{isset($edit)?route('image-app.update',$imageApp->id):route('image-app.store')}}" enctype="multipart/form-data"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf
                        @if(isset($edit))
                            @method('PUT')
                        @endif



                        <div class="form-group">
                            <lable>IMAGE</lable>
                            <input type="file" class="form-control" name="image">
                        </div>
                        @if(isset($edit))
                            <div class="d-flex justify-content-center border rounded">
                                <img src="{{$imageApp->image}}" width="40%">
                            </div>
                        @endif

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">{{isset($edit)?'UPDATE':'SUBMIT'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
