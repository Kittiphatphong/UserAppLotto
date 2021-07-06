@extends('layouts.newApp')
@section('title','Live link')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">LIVE LINK</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('live-link.create')}}" class="text-muted">Live link</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-body pb-0">
            <form action="{{isset($edit)?route('live-link.update',$edit->id):route('live-link.store')}}" method="post" >
                @csrf
                @isset($edit)
                    @method('PATCH')
                @endisset
              <div class="form-group">
                  <label>Link</label>
                  <div class="d-flex justify-content-between">
                  <input type="text" class="form-control" name="link" placeholder="Enter a link..." autocomplete="off" value="{{isset($edit)?$edit->link:''}}">

                          <button class="btn {{isset($edit)?'btn-warning':'btn-success'}}">{{isset($edit)?'EDIT':'SUBMIT'}}</button>
                  </div>

              </div>
            </form>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>LINK</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($live_link as $item)
                        <tr class="
                            @if(isset($edit))
                            @if($edit->id == $item->id)
                            bg-light-warning
                            @endif
                            @endif
                             ">
                            <td>{{$item->id}}</td>
                            <td>{{$item->link}}</td>
                            <td>
                                @if($item->status == 1)
                                    <a href="{{route('live-link.show',$item->id)}}" class="btn btn-primary btn-sm text-white col-10">ON</a>
                                @else
                                    <a href="{{route('live-link.show',$item->id)}}" class="btn btn-light-primary btn-sm text-white col-10">OFF</a>
                                @endif
                            </td>
                            <td>

                                        <div class="d-flex justify-content-start m-0">
                                            <a href="{{route('live-link.edit',$item->id)}}" class="btn btn-link" ><i class="far fa-edit"></i></a>
                                            <form action="{{route('live-link.destroy',$item->id)}}" method="post" class="delete_form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" btn btn-link delete_submit" ><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>



                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
