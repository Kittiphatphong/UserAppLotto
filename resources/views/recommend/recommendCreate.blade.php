@extends('layouts.newApp')
@section('title','Recommend Lotto')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">RECOMMEND LOTTO PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('recommend.create')}}" class="text-muted">Recommend lotto</a>
            </li>
            <li class="breadcrumb-item">
                <a href="" class="text-muted">create</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <p>Recommend</p>

@endsection
