@extends('layouts.newApp')
@section('title','Dashboard')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">DASHBOARD PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}" class="text-muted">Dashboard</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-lg">
            <div class="row">
                <div class="col-xl-4">
                    <!--begin::Stats Widget 18-->
                    <a href="{{route('customer.list')}}" class="card card-custom bg-white bg-hover-state-dark card-stretch gutter-b bgi-no-repeat" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
                        <!--begin::Body-->
                        <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1 tee">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
  <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
</svg>
												</span>
                            <div class="font-weight-bolder font-size-h5 mb-2 mt-5">Customers</div>
                            <div class="font-weight-bold font-size-sm ">All {{$customers[1]}} <span class="text-success"> <span class="fa fa-circle text-success"></span> Active {{$customers[0]}}</span></div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Stats Widget 18-->
                    <a href="#" class="card card-custom bg-white bg-hover-state-dark card-stretch gutter-b bgi-no-repeat" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
                        <!--begin::Body-->
                        <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1 tee">
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
  <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
  <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
</svg>
                            <div class="font-weight-bolder font-size-h5 mb-2 mt-5">Amount buy</div>
                            <div class="font-weight-bold font-size-sm ">{{number_format($billOrders->sum('total'))}} LAK</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Stats Widget 18-->
                    <a href="{{route('customer.list')}}" class="card card-custom bg-white bg-hover-state-dark card-stretch gutter-b bgi-no-repeat" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
                        <!--begin::Body-->
                        <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1 tee">
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
  <path d="M8 0l1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/>
  <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
</svg>
												</span>
                            <div class="font-weight-bolder font-size-h5 mb-2 mt-5">Amount win</div>
                            <div class="font-weight-bold font-size-sm ">{{number_format($billOrders->sum('total_win'))}} LAK</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Stats Widget 18-->
                </div>
            </div>

            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-primary">Result</span>

                    </h3>
                    <div class="card-toolbar">
                    <select class="btn bg-primary">
                        @foreach($results as $result)
                        <option>{{$result->draw}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mt-n3">
                    <h2 class="text-center"><span class="text-danger">ຜົນ​ອອກຫວຍ</span><span class="text-success">ງວດ​ວັນ​ທີ:</span> <span class="border  border-success rounded px-1">{{\Carbon\Carbon::parse($results->first()->created_at)->format('d')}}</span>
                        <span class="border  border-success rounded px-1 ">{{\Carbon\Carbon::parse($results->first()->created_at)->format('m')}}</span>
                        <span class="border  border-success rounded px-1">{{\Carbon\Carbon::parse($results->first()->created_at)->format('Y')}}</span></h2>
                </div>
                <div class="container p-4">
                    <div class="d-flex justify-content-center">
                        <h2 class="col-2 border border-success rounded p-2 text-center"><span class="text-success">ເລກ </span> <span class="text-danger">​6 ໂຕ:</span></h2>
                        <h2 class="col-5 border border-success rounded p-2 text-center bg-success" >
                            <span class="text-danger bg-white border border-success rounded col-1">{{$results->first()->d6}} </span>
                            <span class="text-danger bg-white border border-success rounded col-1">{{$results->first()->d5}} </span>
                            <span class="text-danger bg-white border border-success rounded col-1">{{$results->first()->d4}} </span>
                            <span class="text-danger bg-white border border-success rounded col-1">{{$results->first()->d3}} </span>
                            <span class="text-danger bg-white border border-success rounded col-1">{{$results->first()->d2}} </span>
                            <span class="text-danger bg-white border border-success rounded col-1">{{$results->first()->d1}} </span>
                        </h2>
                    </div>
                    <div>

                    </div>
                </div>
                <!--end::Body-->
            </div>


            <div class="row">
                <div class="col-xl-6">
                    <!--begin::Engage Widget 11-->
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex p-0">
                            <div class="flex-grow-1 p-2 card-rounded flex-grow-1 " >
                                <h6 class="text-success"><b>Recommend lotto today</b></h6>
                                <div id="recommend" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators pt-2">
                                        @foreach($recommends as $image)
                                            <li data-target="#recommend" data-slide-to="{{$loop->index}}" class=" @if($loop->first) active @endif bg-success"></li>

                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach($recommends as $image)
                                            <div class="carousel-item @if($loop->first) active @endif">
                                                <img src="{{$image->image}}" class="d-block w-100 rounded">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-custom card-stretch card-stretch-half gutter-b overflow-hidden">
                        <div class="card-body p-0 d-flex rounded ">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <h6 class="text-success"><b>Promotions</b></h6>
                                <ol class="carousel-indicators">
                                    @foreach($promotions as $promotion)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class=" @if($loop->first) active @endif"></li>

                                    @endforeach
                                </ol>
                                <div class="carousel-inner border rounded ">
                                    @foreach($promotions as $promotion)

                                        <div class="carousel-item @if($loop->first) active @endif">

                                                <h6 class="text-center">{{$promotion->title}}</h6>
                                                <p class="text-center">{{$promotion->content}}</p>

                                            <img class="d-block w-100" src="{{$promotion->image}}">

                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon bg-success" aria-hidden="true"></span>
                                    <span class="sr-only ">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon bg-success" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="transform: scale(1.5) rotate(-26deg); background-image: url('assets/media/products/13.png')"></div>
                        </div>
                    </div>

                    <div class="card card-custom card-stretch card-stretch-half gutter-b overflow-hidden">
                        <div class="card-body p-0 d-flex rounded">

                            <div id="animal" class="carousel slide" data-ride="carousel">
                                <h6 class="text-success"><b>Animals</b></h6>
                                <ol class="carousel-indicators">
                                    @foreach($animals as $animal)
                                        <li data-target="#animal" data-slide-to="{{$loop->index}}" class=" @if($loop->first) active @endif "></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner border rounded  ml-3">
                                    @foreach($animals as $animal)

                                        <div class="carousel-item m @if($loop->first) active @endif">
                                            <div class="float-right mr-4">
                                                <h5 class="text-success pt-2">{{$animal->name}}</h5>
                                                <p>{{str_replace('"','',$animal->animalNos->pluck('animal_digit'))}}</p>
                                            </div>
                                            <img class="w-50 float-left ml-4" src="{{$animal->image}}" alt="First slide">

                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#animal" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon bg-success" aria-hidden="true"></span>
                                    <span class="sr-only ">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#animal" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon bg-success" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="transform: scale(1.5) rotate(-26deg); background-image: url('assets/media/products/12.png')">sdfasdfas</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>













@endsection
