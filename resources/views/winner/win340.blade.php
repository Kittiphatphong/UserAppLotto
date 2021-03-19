@extends('layouts.newApp')
@section('title','Winner 3/40')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">WINNER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Winner</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('win.340')}}" class="text-muted">Winner 3/40</a>
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
                <h3 class="card-label">Win 3/40
                    <span class="d-block text-muted pt-2 font-size-sm">List winning 3/40</span></h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <br><br>
            <div class="mb-15 border rounded p-3">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col1" data-column="0">
                        <label>TRANSACTION ID:</label>
                        <input type="text" class="column_filter form-control" id="col0_filter" placeholder="Search transaction id" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col2" data-column="1">
                        <label>PHONE NO:</label>
                        <input type="text" class="column_filter form-control" id="col1_filter" placeholder="Search phone no" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col3" data-column="2">
                        <label>BILL NUMBER:</label>
                        <input type="text" class="column_filter form-control" id="col2_filter" placeholder="Search bill number" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col4" data-column="3">
                        <label>DIGIT:</label>
                        <input type="text" class="column_filter form-control" id="col3_filter" placeholder="Search digit" />
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col5" data-column="4">
                        <label>WIN MOUNT:</label>
                        <input type="text" class="column_filter form-control" id="col4_filter" onkeyup="format(this)" placeholder="Search money" />
                    </div>

                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>DRAW:</label>
                        <select class="form-control" id="select5" >
                            <option value="">All</option>

                            @foreach($draws as $draw)
                                <option value="{{$draw->draw}}">{{$draw->draw}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>DATE BUY:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control datatable-input" name="start" placeholder="From" data-col-index="7" />
                            <div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-ellipsis-h"></i>
															</span>
                            </div>
                            <input type="text" class="form-control datatable-input" name="end" placeholder="To" data-col-index="7" />
                        </div>
                    </div>

                </div>


            </div>
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>PHONE NO</th>
                        <th>BILL NUMBER</th>
                        <th>DIGIT</th>
                        <th>WIN AMOUNT</th>
                        <th>DRAW </th>
                        <th>DRAW DATE</th>
                        <th>DATE BUY</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->transaction_id}}</td>

                            <td><strong>{{$order->customers->phone}}</strong></td>
                            <td>{{str_replace(',','',number_format($order->bill_number))}}</td>
                            <td>@foreach($order->win340s as $digit)@if(!$loop->first)=@endif{{str_replace(',','-',$digit->digit)}}@endforeach</td>
                            <td><strong>{{number_format($order->total_win)}}</strong></td>
                            <td>{{$order->draw}}</td>
                            <td>{{\Carbon\Carbon::parse(\App\Models\Result::where('draw','=',$order->draw)->pluck('created_at')->first())->toDateString() }}</td>

                            <td>{{$order->created_at}}</td>
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
