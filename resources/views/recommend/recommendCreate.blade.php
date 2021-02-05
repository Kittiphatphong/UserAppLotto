@extends('layouts.newApp')
@section('title','Recommend Lotto')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">RECOMMEND LOTTO PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('recommend.create')}}" class="text-muted">Recommend lotto</a>
            </li>
            <li class="breadcrumb-item">
                <a href="" class="text-muted">create</a>
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
                        <h3 class="card-label">RECOMMEND
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form enctype="multipart/form-data"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" class="form-control" name="title" >
                        </div>
                        <div class="form-group ">
                            <label>CONTENT</label>
                            <input type="text" class="form-control" name="contentShow" >
                        </div>
                        <div class="form-group ">
                            <label>DRAW</label>
                            <input type="number" class="form-control" name="draw" >
                        </div>




                        <div class="form-group">
                            <lable>IMAGES</lable>
                            <input type="file" class="form-control" name="images[]" multiple>
                        </div>
                        <br>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
