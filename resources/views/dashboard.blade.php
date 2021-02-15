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
{{--            <li class="breadcrumb-item">--}}
{{--                <a href="" class="text-muted">Empty Page</a>--}}
{{--            </li>--}}
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')

    <div class="row">
        <div class="col-xl-6">
            <!--begin::Engage Widget 11-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body d-flex p-0">
                    <div class="flex-grow-1 p-2 card-rounded flex-grow-1 " >
                        <h6 class="text-success"><b>Recommend lotto today</b></h6>
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
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
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class=" @if($loop->first) active @endif "></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner border rounded bg-light">
                                @foreach($promotions as $promotion)

                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <div class="pt-2">
                                            <h6 class="text-center">{{$promotion->title}}</h6>
                                            <p class="text-center">{{$promotion->content}}</p>
                                        </div>
                                        <img class="d-block w-100" src="{{$promotion->image}}">
                                        <span class="float-right badge badge-success m-1">{{$loop->index+1}}</span>
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









@endsection
