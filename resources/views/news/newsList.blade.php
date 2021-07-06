@extends('layouts.newApp')
@section('title','News')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">NEWS PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">News</a>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('news.index')}}" class="text-muted">list</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">NEWS
                    <span class="d-block text-muted pt-2 font-size-sm">News list</span></h3>
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
                        <th>IMAGE</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news_list as $news)
                        <tr>
                        <td>{{$news->id}}</td>
                        <td>{{$news->title}}</td>
                            <td>{{$news->content}}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                @foreach($news->newsImages as $images)
                                    <a href="{{$images->image}}" target="_blank" class="mr-1">
                                        <img src="{{$images->image}}" alt="Nature" style="width:100%" class="border rounded">
                                    </a>
                                @endforeach
                                </div>
                            </td>
                            <td>      <div class="d-flex justify-content-start m-0">
                                    <a href="{{route('news.edit',$news->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
                                    <form action="{{route('news.destroy',$news->id)}}" method="post" class="delete_form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                    </form>
                                </div></td>
                            <td>{{$news->updated_at}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
