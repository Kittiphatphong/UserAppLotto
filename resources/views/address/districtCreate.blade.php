@extends('layouts.newApp')
@section('title','District')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">DISTRICT PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">District</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('district.index')}}" class="text-muted">List</a>
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
                        <h3 class="card-label">District
                            <span class="d-block text-muted pt-2 font-size-sm">{{isset($edit)?'Edit':'Create'}} district</span></h3>
                    </div>
                    <form  action="{{isset($edit)?route('district.update',$district->id):route('district.store')}}" method="post">
                        @csrf
                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label>DISTRICT EN</label>
                            <input type="text" class="form-control" name="dr_name_en" value="{{old('dr_name_en',$district->dr_name_en)}}">
                        </div>
                        <div class="form-group">
                            <lable>DISTRICT LA</lable>
                            <input type="text" class="form-control" name="dr_name" value="{{old('dr_name',$district->dr_name)}}">
                        </div>




                        <button class="btn btn-success btn-block" type="submit"><strong>{{isset($edit)?'EDIT':'SUBMIT'}}</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection







