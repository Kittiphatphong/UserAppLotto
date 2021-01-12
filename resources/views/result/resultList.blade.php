@extends('layouts.newApp')
@section('title','Result')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">RESULT PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('result.list')}}" class="text-muted">Result</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Result = <b>Draw @if(\App\Models\BillOrder::count()>0){{\App\Models\BillOrder::where('id',DB::raw("(select max(`id`) from bill_orders)"))->pluck('id')->first()}}@endif</b>
                    <span class="d-block text-muted pt-2 font-size-sm">Result lottory </span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <form action="{{route('result.store')}}" class="d-flex justify-content-end" method="post">
                @csrf

                        <span class="form-control col-2 bg-info text-center">2d4d5d5d6d</span>
                        <input type="search" class="form-control col-2" placeholder="2d4d5d5d6d" maxlength="6" minlength="6" name="2d4d5d5d6d">
                            <span class="form-control col-1 bg-info text-center">3/40</span>
                        <input type="search" class="form-control col-1" placeholder="1/40" maxlength="2" minlength="2" name="animal1">
                        <input type="search" class="form-control col-1" placeholder="2/40" maxlength="2" minlength="2" name="animal2">
                            <input type="search" class="form-control col-1" placeholder="3/40" maxlength="2" minlength="2" name="animal3">

                            <button type="submit" class="btn btn-success form-control col-1">SUBMIT</button><br>


                </form>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="datatable datatable-bordered datatable-head-custom " id="kt_datatable">
                    <thead>
                    <tr>

                        <th>RECORD ID </th>
                        <th>Draw</th>
                        <th>2D3D4D5D6D</th>
                        <th>3/40</th>
                        <th>CREATED AT </th>
                        <th>UPDATED BY</th>
                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>34211</td>
                            <td>12,17,18</td>
                            <td>NOW</td>
                            <td>Jay</td>
                            <td>NOW</td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('input').keyup(function(){
                if($(this).val().length==$(this).attr("maxlength")){
                    $(this).next().focus();
                }
            });
        });
    </script>
@endsection
