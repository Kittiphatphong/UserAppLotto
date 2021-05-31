@extends('layouts.newApp')
@section('title','Fortune')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">FORTUNE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Fortune</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('temple.index')}}" class="text-muted">Temple</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="rounded">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card-title">
                        <h3 class="card-label">{{isset($edit)?'Edit':'New'}} fortune
                            <span class="d-block text-muted pt-2 font-size-sm">Fortune for temple</span></h3>
                    </div>
                    <form  action="{{isset($edit)?route('fortune.update',$edit->id):route('fortune.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label>TEMPLE NAME</label>
                            <input type="text" class="form-control" name="temple_name" value="{{$fortune_index->temple_name}}" disabled>
                        </div>
                        <div class="form-group">
                            <lable>PAPER NO</lable>
                            <input type="number" class="form-control" name="no" placeholder="Enter paper no" value="{{isset($edit)?$edit->no:''}}" required>
                        </div>
                        <div class="form-group">
                            <lable>CONTENT</lable>
                            <textarea class="form-control" rows="10" placeholder="Enter content" name="content" required>{{isset($edit)?$edit->content:''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>IMAGE</label>
                            <input type="file" class="form-control" name="image" {{isset($edit)?'':'required'}}>
                            @isset($edit)
                                <div class="d-flex justify-content-center" >
                                    <img src="{{$edit->image}}" class="py-4">
                                </div>
                            @endisset
                        </div>
                        <input type="hidden" name="temple_id" value="{{$fortune_index->id}}">
                        <button class="btn {{isset($edit)?'btn-warning':'btn-success'}} btn-block" type="submit"><strong>{{isset($edit)?'EDIT':'SUBMIT'}}</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection







