@extends('layouts.newApp')
@section('title','Api log')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">API LOGS PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Log</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('log.index.api')}}" class="text-muted">Api log</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <main class="py-4">
        <div class="container">
            <div class="w-100 d-flex justify-content-between">
                <h3 class="text-center">Api Logger</h3>
                <form method="POST" action="{{ route('apilogs.deletelogs') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger delete-logs" value="Delete Logs">
                    </div>
                </form>
            </div>
            <div class="list-group">
                @forelse ($apilogs as $key => $log)
                    <div class="list-group-item list-group-item-action" style="margin:5px">
                        <div class = "row w-100">
                            <span class="col-md-3">
                                @if ($log->response>400)
                                    <button class="btn btn-danger font-weight-bold">{{$log->method}}</button>
                                @elseif($log->response>300)
                                    <button class="btn btn-info font-weight-bold">{{$log->method}}</button>
                                @else
                                    <button class="btn btn-{{$log->method=="GET"? "primary" : "success"}} font-weight-bold">{{$log->method}}</button>
                                @endif

                                <small class="col-md-2">
                                    <b>{{$log->response}}</b>
                                </small>
                            </span>
                            <large class= "col-md-3"><b>Duration : </b>{{$log->duration * 1000}}ms</large>
                            <large class= "col-md-3"><b>Date : </b>{{$log->created_at}}</large>
                            <p class="col-md-3 mb-1"><b>IP :</b> {{$log->ip}}</p>
                        </div>
                        <hr>
                        <div class="row w-100">
                            <p class="col-md-3 mb-1">
                                <b>URL : </b>{{$log->url}}</br>
                            </p>
                            <p class="col-md-6 mb-1"><b>Models(Retrieved) :</b> {{$log->models}}</p>
                        </div>
                        <div class="row w-100">
                            <p class="col-md-3">
                                <b>Method :</b>   {{$log->action}}
                            </p>
                            <p class="col-md-3 mb-1"><b>Payload : </b>{{$log->payload}}</p>

                            <p class="col-md-6">
                                <b>Controller :</b> {{$log->controller}}

                            </p>

                        </div>
                    </div>
                @empty
                    <h5>
                        No Records
                    </h5>
                @endforelse

            </div>
        </div>
    </main>

@endsection
