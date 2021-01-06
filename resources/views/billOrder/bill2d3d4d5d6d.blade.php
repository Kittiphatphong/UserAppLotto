@extends('layouts.newApp')
@section('title','Dashboard')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">BILL ORDER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span href="#" class="text-muted">Bill order</span>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('bill.2d3d4d5d6d')}}" class="text-muted">Bill 2d3d4d5d6d</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <p>Bill 2d3d4d5d6d</p>

@endsection
