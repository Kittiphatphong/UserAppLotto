@extends('layouts.newApp')
@section('title','Background app')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">BACKGROUND APP PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Background app</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('image-app.index')}}" class="text-muted">List</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <br>
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">BACKGROUND APP
                    <span class="d-block text-muted pt-2 font-size-sm">List background app</span></h3>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('image-app.create')}}" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>New background</a>
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
                        <th>STATUS</th>
                        <th>ACTION</th>
                        <th>CREATED_AT</th>
                        <th>UPDATED_AT</th>
                    </tr>
                    </thead>
                    <tbody>
@foreach($image_app_index as $image)
    <tr>
        <td>{{$image->id}}</td>
        <td><img src="{{$image->image}}" width="100px"></td>
        <td>
            @if($image->active==true)
            <span class="label label-lg font-weight-bold label-light-success label-inline ">Active</span>
            @else
                <span class="label label-lg font-weight-bold label-light-danger label-inline ">Inactive</span>
            @endif
        </td>
        <td>
            <div class="d-flex justify-content-start m-0">
                <a href="{{route('image-app.edit',$image->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
                @if($image->active==true)
                    <button class="btn btn-link"><i class="fas fa-trash text-info"></i></button>

                @else
                <form action="{{route('image-app.destroy',$image->id)}}" method="post" class="delete_form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" btn btn-link" ><i class="fas fa-trash"></i></button>
                </form>
                @endif
                @if($image->active==true)
                    <button class="btn btn-link"><i class="fas fa-check-circle text-info"></i></button>

                @else
                <form action="{{route('image-app.active',$image->id)}}" method="post" class="active_form">
                    @csrf
                    <button type="submit" class=" btn btn-link delete_submit"><i class="fas fa-check-circle"></i></button>
                </form>
               @endif
            </div>
        </td>
        <td>{{$image->created_at}}</td>
        <td>{{$image->updated_at}}</td>
    </tr>
@endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>


@endsection







