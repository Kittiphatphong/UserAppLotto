@extends('layouts.newApp')
@section('title','Customer List')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">CUSTOMER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">Customers</a>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('customer.list')}}" class="text-muted">List</a>
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
                <h3 class="card-label">CUSTOMERS
                    <span class="d-block text-muted pt-2 font-size-sm">List customer register and customer buy lottory</span></h3>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('customer.register')}}" class="btn btn-primary font-weight-bolder">
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
											</span>Register</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <br><br>
            <div class="mb-15 border rounded p-3">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col2" data-column="1">
                        <label>PHONE NO:</label>
                        <input type="text" class="column_filter form-control" id="col1_filter" placeholder="Search phone no" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col3" data-column="2">
                        <label>NAME:</label>
                        <input type="text" class="column_filter form-control" id="col2_filter" placeholder="Search name" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6" id="filter_col4" data-column="3">
                        <label>GENDER:</label>
                        <input type="text" class="column_filter form-control" id="col3_filter" placeholder="" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>STATUS:</label>
                        <select class="form-control" id="select6" >
                            <option value="">All</option>
                            <option value="Success">Success</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancle">Cancle</option>
                        </select>
                    </div>

                </div>
                <div class="row mb-8">

                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>CREATE AT:</label>
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
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>BIRTHDAY</th>
                    <th>TOTAL BUY</th>
                    <th>AMOUNT BUY</th>
                    <th>AMOUNT WIN</th>
                    <th>Status</th>
                    <th>CREATED AT</th>

                </tr>
                </thead>
               <tbody>
               @foreach($customers as $customer)
               <tr>
<td>{{$customer->id}}</td>
                   <td><div class="d-flex justify-content-between">
                       <span class="float-left">{{$customer->phone}}</span>
                       <form action="{{route('customer.delete',$customer->id)}}" method="post" class="delete_form">
                           @csrf <button type="submit" class="btn btn-link text-danger m-0 p-0 " ><i class="fa fa-trash-alt text-danger"></i></button></form>
                       </div>
                   </td>

                   <td>@if($customer->firstname==null)<span class="text-danger">N/A</span> @else{{$customer->firstname}} {{$customer->lastname}}@endif</td>
                   <td>@if($customer->firstname==null)<span class="text-danger">N/A</span> @else{{$customer->gender}}@endif</td>
                   <td>@if($customer->firstname==null)<span class="text-danger">N/A</span> @else{{$customer->birthday}}@endif</td>

                   <td>{{$customer->orders->where('status_buy',true)->count()}}</td>
                   <td>{{number_format($customer->orders->where('status_buy',true)->sum('total'))}}</td>


                    <td>{{number_format($customer->orders->where('status_buy',true)->sum('total_win'))}}</td>
                   <td class="text-center">
                       @if($customer->otps != null)

                       @if($customer->otps->status == 1)<span class="label label-lg font-weight-bold label-light-success label-inline ">Success</span>
                       @elseif($customer->otps->status == 0)<span class="label label-lg font-weight-bold label-light-primary label-inline ">Pending</span>
                       @else    <span class="label label-lg font-weight-bold label-light-danger label-inline ">Cancle</span>
                       @endif

                           @endif
                   </td>

                   <td>{{$customer->created_at}}</td>
               </tr>
               @endforeach
               </tbody>
            </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>
@endsection







