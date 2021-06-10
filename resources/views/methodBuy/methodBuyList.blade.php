 @extends('layouts.newApp')
@section('title','Method buy')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">HOW TO BUY PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">How to buy</a>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('method-buy.index')}}" class="text-muted">list</a>
                        </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">HOW TO BUY
{{--                    <span class="d-block text-muted pt-2 font-size-sm">Recommend each draw</span>--}}
                </h3>
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
                        <th>DESCRIPTION</th>
                        <th>LINK</th>
                        <th>IMAGE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>

                        <th>UPDATED AT</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($method_buy_list as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->link}}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                @foreach($item->methodBuyImages as $images)
                                    <a href="{{$images->image}}" target="_blank" class="mr-1">
                                        <img src="{{$images->image}}" alt="Nature" style="width:100%" class="border rounded">
                                    </a>
                                @endforeach
                                </div>
                            </td>
                            <td>
                                @if($item->status == 1)
                                    <a href="{{route('method-buy.show',$item->id)}}" class="btn btn-primary btn-sm text-white col-10">ON</a>
                                @else
                                    <a href="{{route('method-buy.show',$item->id)}}" class="btn btn-light-primary btn-sm text-white col-10">OFF</a>
                                @endif
                            </td>
                            <td>      <div class="d-flex justify-content-start m-0">
                                    <a href="{{route('method-buy.edit',$item->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
                                    <form action="{{route('method-buy.destroy',$item->id)}}" method="post" class="delete_form">
                                        @csrf
                                        <button type="submit" class=" btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
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
