@extends('layouts.newApp')
@section('title','Dashboard')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">CUSTOMER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Customers</a>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('')}}" class="text-muted">List</a>
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
                    <form  action="{{route('customer.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>FIRST NAME</label>
                            <input type="text" class="form-control" name="firstname">
                        </div>
                        <div class="form-group">
                            <lable>LAST NAME</lable>
                            <input type="text" class="form-control" name="lastname">
                        </div>
                        <div class="form-group">
                            <lable>PHONE NO</lable>
                            <input type="number" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <lable>GENDER</lable>
                            <select class="form-control col-12" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <lable>BIRTHDAY</lable>
                            <input type="date" class="form-control" name="birthday">
                        </div>
                        <div class="form-group">
                            <lable>PASSWORD</lable>
                            <input type="password" name="password" class="form-control" autocomplete="off">
                        </div>
                        <button class="btn btn-success btn-block" type="submit"><strong>SUBMIT</strong></button>
                    </form>
                    <div class="mt-5">
                        Customer list
                        @foreach($customers as $customer)
                            <p>{{$customer->phone}} {{$customer->firstname}} {{$customer->lastname}} </p>
                        @endForeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection







