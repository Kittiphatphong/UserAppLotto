@extends('layouts.newApp')
@section('title','How to buy category')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">HOW TO BUY CATEGORIES PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('method-buy-category.index')}}" class="text-muted">How to buy categories page</a>
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
                        <h3 class="card-label">How to buy category
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form  action="{{isset($edit)? route('method-buy-category.update',$edit->id):route('method-buy-category.store')}}"  method="post" height="1000px" class="pb-10 mb-10" enctype="multipart/form-data">
                        @csrf

                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" class="form-control" name="name" value="{{isset($edit)?$edit->name:''}}" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" >
                            @if(isset($edit))
                                <div class="d-flex justify-content-center mt-4 border rounded">
                                    <br><br><br><br><br><br><br><br><br>
                                    <img src="{{$edit->image}}" width="50%">
                                </div>
                            @endif
                        </div>


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
