@extends('layouts.newApp')
@section('title','Recommend Lotto')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">RECOMMEND LOTTO PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Recommend lotto</a>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('recommend.list')}}" class="text-muted">list</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">RECOMMEND
                    <span class="d-block text-muted pt-2 font-size-sm">Recommend each draw</span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

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
                        <th>DRAW</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recommend_list as $recommend)
                        <tr>
                        <td>{{$recommend->id}}</td>
                        <td>{{$recommend->title}}</td>
                            <td>{{$recommend->content}}</td>
                            <td>{{$recommend->draw}}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                @foreach($recommend->recommendImages as $images)
                                    <a href="{{$images->image}}" target="_blank" class="mr-1">
                                        <img src="{{$images->image}}" alt="Nature" style="width:100%" class="border rounded">
                                    </a>
                                @endforeach
                                </div>
                            </td>
                            <td>      <div class="d-flex justify-content-start m-0">
                                    <a href="{{route('recommend.edit',$recommend->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
                                    <form action="{{route('recommend.delete',$recommend->id)}}" method="post" class="delete_form">
                                        @csrf
                                        <button type="submit" class=" btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </div></td>
                            <td>{{$recommend->updated_at}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
