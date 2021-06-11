@extends('layouts.newApp')
@section('title','Zodiac')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">ZODIAC PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('zodiac.index')}}" class="text-muted">Zodiac</a>
            </li>
            {{--                        <li class="breadcrumb-item">--}}
            {{--                            <a href="{{route('news.index')}}" class="text-muted">list</a>--}}
            {{--                        </li>--}}
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
                        <h3 class="card-label">Zodiac
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{isset($edit)? route('zodiac.update',$edit->id):route('zodiac.store')}}"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf

                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" class="form-control" name="name" value="{{isset($edit)?$edit->name:''}}" placeholder="Enter name">
                        </div>
                        <div class="form-group ">
                            <label>START PERIOD</label>
                            <input type="date" class="form-control" name="start" value="{{isset($edit)?$edit->start:''}}" placeholder="Enter start period">
                        </div>

                        <div class="form-group ">
                            <label>END PERIOD</label>
                            <input type="date" class="form-control" name="end" value="{{isset($edit)?$edit->end:''}}" placeholder="Enter end period">
                        </div>

                        <div class="form-group">
                            <lable>ICON</lable>
                            <input type="file" class="form-control" name="image" >
                        </div>
                        @if(isset($edit))
                        <div class="d-flex col-12 border justify-content-center flex-wrap">

                                <div class="col-3 py-2">
                                <a href="{{$edit->image}}" target="_blank" class="">
                                    <img src="{{$edit->image}}"  loading="lazy" width="90%" class="border rounded">
                                </a>
                                </div>
                        </div>
                        @endif
                        <br>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">{{isset($edit)?'UPDATE':'SUBMIT'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
