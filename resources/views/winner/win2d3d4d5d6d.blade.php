@extends('layouts.newApp')
@section('title','Winner 2d3d4d5d6d')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">WINNER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Winner</span>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('win.2d3d4d5d6d')}}" class="text-muted">Winner 2d3d4d5d6d</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Winner 2d3d4d5d6d
                    <span class="d-block text-muted pt-2 font-size-sm">List bill winning 2d3d4d5d6d</span></h3>
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
            <table class="datatable datatable-bordered datatable-head-custom " id="kt_datatable">
                <thead>
                <tr>
                    <th>DRAW </th>
                    <th>PHONE NO</th>
                    <th>BILL NUMBER</th>
                    <th>DRAW DATE</th>
                    <th>DIGIT</th>
                    <th>WIN AMOUNT</th>
                    <th>DATE BUY</th>
                    <th>Name</th>

                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->draw}}</td>
                        <td><strong>{{$order->customers->phone}}</strong></td>
                        <td>{{str_replace(',','',number_format($order->bill_number))}}</td>
                        <td>{{\Carbon\Carbon::parse(\App\Models\Result::where('draw','=',$order->draw)->pluck('created_at')->first())->toDateString() }}</td>

                        <td class="row">
                            @foreach($order->win2d3d4d5d6ds as $digit)@if(!$loop->first)=@endif{{$digit->digit}}@endforeach
                        </td>
                        <td>{{number_format($order->total_win)}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->customers->firstname}} {{$order->customers->lastname}}</td>


                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
