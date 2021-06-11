@extends('layouts.newApp')
@section('title','Zodiac')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">ZODIAC PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('zodiac.index')}}" class="text-muted">Zodiac</a>
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
                <h3 class="card-label">Zodiac
                 </h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('zodiac.create')}}" class="btn btn-primary font-weight-bolder">
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
                        <th>TITLE</th>
                        <th>CONTENT</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zodiac as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                            <td>{{$item->content}}</td>
                            <td>
                                <div class="d-flex justify-content-start">

                                    <a href="{{$item->image}}" target="_blank" class="mr-1">
                                        <img src="{{$item->image}}" alt="Nature" style="width:100%" class="border rounded">
                                    </a>

                                </div>
                            </td>
                            <td>      <div class="d-flex justify-content-start m-0">
                                    <a href="" class="btn btn-link" ><i class="far fa-edit"></i></a>
                                    <form action="" method="post" class="delete_form">
                                        @csrf
                                        <button type="submit" class="btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </div></td>
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
