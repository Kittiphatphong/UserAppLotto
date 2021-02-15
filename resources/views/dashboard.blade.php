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

        <div class="col-xl-4">
            <!--begin::Engage Widget Recommend lotto-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body d-flex p-0">
                    <div class="flex-grow-1  px-2 py-2 card-rounded flex-grow-1" style="background-color: #FFFE03;">
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

        <div class="col-xl-4">
            <!--begin::Engage Widget Recommend lotto-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body d-flex p-0">
                    <div class="flex-grow-1  px-2 py-2  card-rounded flex-grow-1" style="background-color: #FFFE03;">
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
                                    <span class="float-right badge badge-success m-1">{{$loop->index+1}}</span>
                                    <img class="d-block w-100" src="{{$promotion->image}}" alt="First slide">

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

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <h6 class="text-success"><b>Animals</b></h6>

                            <div class="carousel-inner border rounded bg-light">
                                @foreach($animals as $animal)

                                    <div class="carousel-item @if($loop->first) active @endif">

                                        <img class="d-block w-50 ml-10" src="{{$animal->image}}" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block d-flex justify-content-between">
                                            <h5 class="text-success pl-4">fasdfsdf</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>

@endsection
