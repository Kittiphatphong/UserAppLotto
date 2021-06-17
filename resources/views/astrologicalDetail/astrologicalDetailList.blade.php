@extends('layouts.newApp')
@section('title','Astrological detail')

@section('header')


    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">ASTROLOGICAL DETAIL PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('astrological-detail.index')}}" class="text-muted">Astrological detail</a>
            </li>
{{--                        <li class="breadcrumb-item">--}}
{{--                            <a href="{{route('news.index')}}" class="text-muted">list</a>--}}
{{--                        </li>--}}
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Astrological detail
                 </h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('astrological-detail.create')}}" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
									          <i class="fa fa-plus-square"></i>
											</span>New</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->


            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>

                        <th>ID</th>
                        <th>ASTROLOGICAL</th>
                        <th>DRAW</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                        <th>DIGITS</th>
                        <th>UPDATED AT</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($astrologicalDetail as $item)
                        <tr @if($item->status ==1) class="bg-light-primary" @endif>
                        <td>{{$item->id}}</td>
                        <td>{{$item->astrologicals->name}}</td>
                            <td>{{$item->draws->draw}}</td>
                            <td>
                                <a href="{{$item->image}}" target="_blank">
                                    <img src="{{$item->image}}" width="150px">
                                </a>
                            </td>


                            <td>      <div class="d-flex justify-content-start m-0">
                                    <a href="{{route('astrological-detail.edit',$item->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>

                                    <form action="{{route('astrological-detail.destroy',$item->id)}}" method="post" class="delete_form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>@foreach(json_decode($item->digit) as $digit){{$digit}}@if(!$loop->last)-@endif
                                @endforeach</td>
                            <td>{{$item->updated_at}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
