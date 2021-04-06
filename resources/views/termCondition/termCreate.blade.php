@extends('layouts.newApp')
@section('title','Term and condition')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">TERM AND CONDITION PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Term and condition</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('term-condition.index')}}" class="text-muted">Index</a>
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
                        <h3 class="card-label">Term and condition
                            <span class="d-block text-muted pt-2 font-size-sm">{{isset($edit)?'Edit':'Create'}} term and condition</span></h3>
                    </div>
                    <form  action="{{isset($edit)?route('term-condition.update',$term->id):route('term-condition.store')}}" method="post">
                        @csrf
                        @isset($edit)
                        @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" class="form-control" name="title" value="{{old('title',$term->title)}}">
                        </div>
                        <div class="form-group">
                            <lable>CONTENT</lable>
                            <textarea type="text" class="form-control" name="content"  rows="10">{{old('content',$term->content)}}</textarea>
                        </div>




                        <button class="btn btn-success btn-block" type="submit"><strong>{{isset($edit)?'EDIT':'SUBMIT'}}</strong></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection







