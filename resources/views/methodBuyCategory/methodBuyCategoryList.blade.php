@extends('layouts.newApp')
@section('title','How to buy category')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">HOW TO BUY CATEGORIES PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('method-buy-category.index')}}" class="text-muted">How to buy categories </a>
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
                <h3 class="card-label">How to buy categories
                 </h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('method-buy-category.create')}}" class="btn btn-primary font-weight-bolder">
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

                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($method_buy_categories as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                            <td><img src="{{$item->image}}" alt="image" width="100px" class="rounded"></td>
                        <td>{{$item->name}}</td>
                            <td>{{$item->methodBuys->count()}}</td>
                            <td>      <div class="d-flex justify-content-start m-0">
                                    <a href="{{route('method-buy-category.edit',$item->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>

                                    <form action="{{route('method-buy-category.destroy',$item->id)}}" method="post" class="delete_form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
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
