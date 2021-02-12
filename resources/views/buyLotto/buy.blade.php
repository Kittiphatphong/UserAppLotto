@extends('layouts.newApp')
@section('title','Buy lotto')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">BUY PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('buy.buy')}}" class="text-muted">BUY</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')


    <div class="rounded container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200 pb-4">
                    <div class="card-title">
                        <h3 class="card-label">BUY LOTTO {{$draw}}
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <div class="mt-4 col-12">
                        <h2>2D3D4D5D6D</h2>
                        <form  action="{{route('buy.store6d')}}" class="d-flex justify-content-start col-12 p-4 border rounded" method="post">
                            @csrf
                            <span class="form-control bg-info text-center col-2">2d3d4d5d6d</span>
                            <input type="number" class="form-control col-3" placeholder="phone no" maxlength="10" minlength="10" name="phone_no" >
                            <input type="search" class="form-control col-3" placeholder="2d4d5d5d6d" maxlength="6" minlength="2" name="digit" >
                            <input type="search" class="form-control col-3" placeholder="money"  name="money" onkeyup="format(this)">
                            <button type="submit" class="btn btn-success form-control ">SUBMIT</button>

                        </form>

                    </div>



                    <div class="mt-4 col-12">
                        <h2>3/40</h2>
                        <form action="{{route('buy.store40')}}" class="d-flex justify-content-start col-12 p-4 border rounded " method="post">
                            @csrf
                            <span class="form-control  bg-info text-center col-2">3/40</span>
                            <input type="number" class="form-control col-3" placeholder="phone no" maxlength="10" minlength="10" name="phone_no" >
                            <input type="search" class="form-control col-1" placeholder="1/40" maxlength="2" minlength="2" name="animal1" >
                            <input type="search" class="form-control col-1" placeholder="2/40" maxlength="2" minlength="2" name="animal2" >
                            <input type="search" class="form-control col-1" placeholder="3/40" maxlength="2" minlength="2" name="animal3" >
                            <input type="search" class="form-control col-3" placeholder="money"  name="money" onkeyup="format(this)">
                            <button type="submit" class="btn btn-success form-control ">SUBMIT</button>
                        </form>




                    </div>
                </div>
            </div>
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
    <script>
        function format(input) {
            var nStr = input.value + '';
            nStr = nStr.replace(/\,/g, "");
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            input.value = x1 + x2;
        }
    </script>
@endsection
