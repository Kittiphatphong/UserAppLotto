@extends('layouts.newApp')
@section('title','Astrological detail')

@section('header')
    <style>
        ul {
            list-style-type: none;
        }

        li {
            display: inline-block;
        }

        input[type="checkbox"][id^="myCheckbox"] {
            display: none;
        }

        label {
            /*border: 1px solid #fff;*/
            /*padding: 5px;*/
            display: block;
            position: relative;
            margin: 10px;
            cursor: pointer;
        }

        label:before {
            background-color: white;
            color: white;
            content: " ";
            display: block;
            border-radius: 50%;
            border: 1px solid grey;
            position: absolute;
            top: -5px;
            left: -5px;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 28px;
            transition-duration: 0.4s;
            transform: scale(0);
        }

        label img {
            height: 65px;
            width: 90px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        :checked + label {
            border-color: #ddd;
            background-color: #C9F7F5;
            border-radius: 5%;
        }


        :checked + label:before {
            content: "✓";
            background-color: #1BC5BD;
            transform: scale(1);
        }

        :checked + label img {
            transform: scale(0.9);
            /* box-shadow: 0 0 5px #333; */
            z-index: -1;
        }
    </style>

    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">ASTROLOGICAL DETAIL PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('astrological-detail.index')}}" class="text-muted">Astrological detail</a>
            </li>
            {{--                        <li class="breadcrumb-item">--}}
            {{--                            <a href="{{route('news.index')}}" class="text-muted">list</a>--}}
            {{--                        </li>--}}
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
                        <h3 class="card-label">Astrological
                            <span class="d-block text-muted pt-2 font-size-sm">DRAW: {{$draw['draw_date']}} [ {{$draw['draw_no']}} ]</span></h3>
                    </div>


                    <form  enctype="multipart/form-data" action="{{isset($edit)? route('astrological-detail.update',$edit->id):route('astrological-detail.store')}}"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf

                        @isset($edit)
                            @method('PATCH')
                        @endisset
                        @if(!isset($edit))
<div class="form-group">
    <lable>Astrological</lable>
    <select class="form-control" name="astrological_id">
        <option value=null disabled selected>Choose astrological</option>
        @foreach($astrological_list as $item)
        <option value="{{$item->id}}"
        @isset($edit)    @if($edit->id == $item->id) selected @endif @endisset
        >
            {{$item->name}}</option>
        @endforeach
    </select>
</div>
                        @endisset
                        <div class="form-group">
                            <label>DIGIT</label>
                            <ul class="border rounded py-4 ">
                                @foreach($animals as $key =>$animal)
                                    <li class="border rounded text-center">
                                        <input type="checkbox" id="myCheckbox{{$key+1}}" name="animals[]" value="{{$animal->id}}"
                                        @isset($edit)
                                        @if(in_array($animal->animals_digit[0],json_decode($edit->digit) ))
                                            checked
                                            @endif
                                        @endisset
                                        />
                                        <label for="myCheckbox{{$key+1}}"><img src="{{$animal->image}}" /></label>
                                        <span >{{$animal->name}} @foreach($animal->animals_digit as $digit) {{$digit}} @endforeach</span>
                                    </li>
                                @endforeach



                            </ul>

                        </div>

                        <div class="form-group">
                            <label>IMAGE</label>
                            <input type="file" class="form-control" name="image" {{isset($edit)?'':'required'}}>
                            @isset($edit)
                                <div class="d-flex justify-content-center" >
                                    <img src="{{$edit->image}}" class="py-4" width="50%">
                                </div>
                            @endisset
                        </div>

                        <br>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">{{isset($edit)?'UPDATE':'SUBMIT'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
