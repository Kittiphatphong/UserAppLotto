@extends('layouts.newApp')
@section('title','Dashboard')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">DASHBOARD PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}" class="text-muted">Dashboard</a>
            </li>
{{--            <li class="breadcrumb-item">--}}
{{--                <a href="" class="text-muted">Empty Page</a>--}}
{{--            </li>--}}
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
<p>Dashboard</p>

@endsection
