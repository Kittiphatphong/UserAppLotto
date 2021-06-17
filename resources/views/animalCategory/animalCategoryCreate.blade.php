@extends('layouts.newApp')
@section('title','Animal category')

@section('header')

    <link href="assets/css/checkboxImage.css" rel="stylesheet" type="text/css" />

    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">ANIMAL CATEGORY PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('animal-category.index')}}" class="text-muted">Animal category</a>
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
                        <h3 class="card-label">Animal category</h3>
                    </div>


                    <form  action="{{isset($edit)? route('animal-category.update',$edit->id):route('animal-category.store')}}"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf

                        @isset($edit)
                            @method('PATCH')
                        @endisset
                          <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" name="name" placeholder="Enter category name..." value="{{isset($edit)?$edit->name:''}}">
                          </div>

                        <div class="form-group">
                            <ul class="border rounded py-4 ">
                                @foreach($animals as $key =>$animal)
                                    <li class="border rounded text-center">
                                        <input type="checkbox" id="myCheckbox{{$key+1}}" name="animals[]" value="{{$animal->id}}"
                                        @isset($edit)
                                        @if(in_array($animal->id,$edit->withAnimals->pluck('animal_id')->toArray()))
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
