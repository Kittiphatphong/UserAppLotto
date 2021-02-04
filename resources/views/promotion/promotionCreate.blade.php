@extends('layouts.newApp')
@section('title','Promotion')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">PROMOTION PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">Promotion</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('promotion.create')}}" class="text-muted">Promotion {{isset($edit)?'Edit':'New'}}</a>
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
                        <h3 class="card-label">PROMOTION
                            <span class="d-block text-muted pt-2 font-size-sm">{{isset($edit)?'Edit promotion':'Create new promotion'}}</span></h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{isset($edit)?route('promotion.update',$promotion->id):route('promotion.store')}}" method="post" height="1000px" class="pb-10 mb-10">
                        @csrf
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" class="form-control" name="title" value="{{old('title',$promotion->title)}}">
                        </div>
                        <div class="form-group">
                            <lable>CONTENT</lable>
                            <textarea class="form-control" id="exampleTextarea" rows="10" name="content" style="resize:none">{{old('content',$promotion->content)}}</textarea>
                        </div>

                        <div class="form-group">
                            <lable>IMAGE</lable>
                            <input type="file" class="form-control" name="image" value="{{old('image',$promotion->image)}}">
                            @if(isset($edit))
                                <div class="centered">
                                <img src="{{$promotion->image}}" width="50%">
                                </div>
                            @endif
                        </div>
                        <div class="form-group justify-content-between ">
                            <lable>DATETIME</lable>

                                <div class="row">
                                    <div class="col">
                                        <div class="input-group date" id="kt_datetimepicker_7_1" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" placeholder="Start date" data-target="#kt_datetimepicker_7_1" name="start"
                                                   @if(isset($edit))
                                                   value="{{old('start',\Carbon\Carbon::parse($promotion->start)->isoFormat('MM/DD/Y h:mm A'))}}"
                                                   @else
                                                   value="{{old('start',$promotion->start)}}"
                                                   @endif
                                            />
                                            <div class="input-group-append" data-target="#kt_datetimepicker_7_1" data-toggle="datetimepicker">
																	<span class="input-group-text">
																		<i class="ki ki-calendar"></i>
																	</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group date" id="kt_datetimepicker_7_2" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" placeholder="End date" data-target="#kt_datetimepicker_7_2" name="end"
                                                   @if(isset($edit))
                                                   value="{{old('end',\Carbon\Carbon::parse($promotion->end)->isoFormat('MM/DD/Y h:mm A'))}}"
                                                   @else
                                                   value="{{old('start',$promotion->end)}}"
                                                @endif
                                            />
                                            <div class="input-group-append" data-target="#kt_datetimepicker_7_2" data-toggle="datetimepicker">
																	<span class="input-group-text">
																		<i class="ki ki-calendar"></i>
																	</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>


                        <button class="btn btn-success btn-block" type="submit"><strong>SUBMIT</strong></button>
<br><br><br><br><br><br><br><br><br><br><br>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
