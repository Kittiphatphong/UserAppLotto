@extends('layouts.newApp')
@section('title','Winner 2d3d4d5d6d')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">WINNER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Winner</span>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('win.2d3d4d5d6d')}}" class="text-muted">Winner 2d3d4d5d6d</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <p>Winner 2d3d4d5d6d</p>

@endsection
