@extends('layouts.newApp')
@section('title','Fortune')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">FORTUNE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Fortune</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('temple.index')}}" class="text-muted">Temple</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Fortune
                    <span class="d-block text-muted pt-2 font-size-sm">{{$fortune_index->temple_name}}</span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <form action="{{route('fortune.create')}}">
                    <input type="hidden" value="{{$fortune_index->id}}" name="temple_id">
                    <button type="submit" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
											<i class="fas fa-sticky-note"></i>
											</span>New fortune</button>
                </form>


            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>IMAGE</th>
                        <th>CONTENT</th>
                        <th>ACTION</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fortune_index->fortunes as $fortune)
                        <tr>
                            <td>{{$fortune->no}}</td>
                            <td><img src="{{$fortune->image}}" width="100px" class="border rounded"></td>
                            <td>{{$fortune->content}}</td>

                            <td>
                                <div class="d-flex justify-content-around">
                                <a href="{{route('fortune.edit',$fortune->id)}}" class="btn btn-link"><i class="fa fa-edit"></i></a>
                                <form action="{{route('fortune.destroy',$fortune->id)}}" method="post" class="delete_form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link " ><i class="fa fa-trash-alt"></i></button>
                                </form>
                                </div>
                            </td>
                            <td>{{$fortune->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
