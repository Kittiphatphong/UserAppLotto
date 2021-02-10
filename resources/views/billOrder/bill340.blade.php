@extends('layouts.newApp')
@section('title','Dashboard')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">BILL ORDER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span href="#" class="text-muted">Bill order</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('bill.340')}}" class="text-muted">Bill 3/40</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
      <div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Bill 3/40
                <span class="d-block text-muted pt-2 font-size-sm">List bill order 3/40</span></h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->

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
        <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
            <thead>
            <tr>

                <th>RECORD ID </th>
                <th>PHONE NO</th>
                <th>BILL NUMBER</th>
                <th>CODE</th>
                <th>MONEY</th>
                <th>DRAW</th>
                <th>DATE BUY</th>
                <th>Name</th>

            </tr>
            </thead>
            <tbody>
            @foreach($bills as $order)
                <tr>
                    <td>{{$order->id}} </td>
                    <td><strong>{{$order->customers->phone}}</strong></td>
                    <td>{{$order->bill_number}}</td>
                    <td>@foreach($order->digit as $animal)
                            [<strong>{{$animal}}</strong>]
                        @endforeach</td>
                    <td><strong>{{number_format($order->money)}}</strong></td>
                    <td>{{$order->draw}}</td>
                    <td>{{$order->updated_at}}</td>
                    <td>{{$order->customers->firstname}} {{$order->customers->lastname}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <!--end: Datatable-->
    </div>
    </div>

@endsection
