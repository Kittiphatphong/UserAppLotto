@extends('layouts.newApp')
@section('title','Province')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">PROVINCE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Province</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('province.index')}}" class="text-muted">List</a>
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
                        <h3 class="card-label">Province
                            <span class="d-block text-muted pt-2 font-size-sm">{{isset($edit)?'Edit':'Create'}} term and condition</span></h3>
                    </div>
                    <form  action="{{isset($edit)?route('province.update',$province->id):route('province.store')}}" method="post">
                        @csrf
                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label>NAME EN</label>
                            <input type="text" class="form-control" name="pr_name_en" value="{{old('pr_name_en',$province->pr_name_en)}}">
                        </div>
                        <div class="form-group">
                            <lable>NAME LA</lable>
                            <input type="text" class="form-control" name="pr_name" value="{{old('pr_name',$province->pr_name)}}">
                        </div>




                        <button class="btn btn-success btn-block" type="submit"><strong>{{isset($edit)?'EDIT':'SUBMIT'}}</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection







