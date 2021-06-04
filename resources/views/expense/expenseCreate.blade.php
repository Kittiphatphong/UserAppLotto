@extends('layouts.newApp')
@section('title','Expense type')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">EXPENSE TYPE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Expenses</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('expense-type.index')}}" class="text-muted">Type</a>
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
                        <h3 class="card-label">EXPENSE TYPE {{isset($edit)?'EDIT':'NEW' }}
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form action="{{isset($edit)? route('expense-type.update',$edit->id) :route('expense-type.store')}}" enctype="multipart/form-data"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf
                        @isset($edit)
                        @method('PATCH')
                        @endisset

                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" class="form-control" name="name" value="{{isset($edit)?$edit->name:''}}" placeholder="Enter name of expense type">
                        </div>
                        <div class="form-group">
                            <lable>Income or Expense</lable>
                            <select class="form-control" name="income_expense">
                                <option value=1
                                    @isset($edit)
                                   @if($edit->income_expense === 1) selected @endif
                                    @endisset>Income</option>
                                <option value=0
                                        @isset($edit)
                                        @if($edit->income_expense === 0) selected @endif
                                    @endisset
                                >Expense</option>

                            </select>

                        </div>

{{--                        <div class="form-group">--}}
{{--                            <lable>ICON</lable>--}}
{{--                            <input type="file" class="form-control" name="image">--}}
{{--                        </div>--}}
{{--                        @isset($notification_info)--}}
{{--                            <div class="d-flex justify-content-center border rounded">--}}
{{--                            <img src="{{$notification_info->icon}}" width="40%">--}}
{{--                            </div>--}}
{{--                        @endisset--}}
                        <br>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">{{isset($notification_info)?'UPDATE':'SUBMIT'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
