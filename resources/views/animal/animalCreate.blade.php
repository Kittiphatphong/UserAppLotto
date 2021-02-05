@extends('layouts.newApp')
@section('title','Animals')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">40 ANIMALS PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">40 Animals</span>
            </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('animal.create')}}"class="text-muted">Create</a>
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
                        <h3 class="card-label">ANIMAL
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <form enctype="multipart/form-data"  method="post" height="1000px" class="pb-10 mb-10">
                        @csrf
                        <div class="form-group">
                            <label >NAME</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group ">
                            <label>ANIMAL DIGIT</label>
                            <input type="text" class="form-control" name="animalDigit" value="" maxlength="2">
                        </div>


                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <input type="text" class="form-control" name="description" value="">
                        </div>
                        <div class="form-group">
                            <label>DIGIT</label>
                            <input type="text" class="form-control" name="digit" value="" onkeyup="format(this)">
                        </div>

                        <div class="form-group">
                            <lable>IMAGE</lable>
                            <input type="file" class="form-control" name="image" >
                        </div>
                        <br>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
