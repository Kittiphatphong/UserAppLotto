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
                <a href="{{route('dream-teller.create')}}" class="text-muted">create</a>
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
                        <h3 class="card-label">DREAM TELLER
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form action="{{isset($dreamTeller)?route('dream-teller.update',$dreamTeller->id):route('dream-teller.store')}}" enctype="multipart/form-data"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf
                        @if(isset($dreamTeller))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" class="form-control" name="title" value="{{isset($dreamTeller)?$dreamTeller->title:''}}">
                        </div>
                        <div class="form-group ">
                            <label>CONTENT</label>
                            <input type="text" class="form-control" name="contentShow" value="{{isset($dreamTeller)?$dreamTeller->content:''}}">
                        </div>
                        <div class="form-group">
                            <label>RECOMMEND DIGITS</label>
                            <input type="text" class="form-control" name="recommendDigits" value="{{isset($dreamTeller)?str_replace('"','',implode(',',$dreamTeller->recommend_digits)):''}}">
                        </div>




                        <div class="form-group">
                            <lable>IMAGE</lable>
                            <input type="file" class="form-control" name="images">
                        </div>
                        @if(isset($dreamTeller))
                            <div class="d-flex justify-content-center border rounded">
                                <img src="{{$dreamTeller->dreamTellerImages->first()->image}}" width="40%">
                            </div>
                        @endif

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">{{isset($dreamTeller)?'UPDATE':'SUBMIT'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
