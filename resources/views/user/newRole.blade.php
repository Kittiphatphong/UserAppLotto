@extends('layouts.newApp')
@section('title','User role')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">USER ROLE PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span class="text-muted">User role</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('users.index')}}"class="text-muted">Role</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{isset($role)?'Edit':'New'}} role
                    <span class="d-block text-muted pt-2 font-size-sm">User role</span></h3>
                <span class="float-right"></span>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{route('users.role')}}" class="btn btn-primary font-weight-bolder">Role list</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
              <form method="post" action="{{isset($role)?route('update.permission',$role->id) :route('store.permission')}}">
                  @csrf
                  <div class="form-group">
                      <label>Role name</label>
                      <input type="text" class="form-control" name="role" placeholder="Enter role name" value="{{isset($role)?$role->name:''}}">
                  </div>

                  <h6>Permissions</h6>
                  <div class="form-group border rounded p-4 ">
                      <div class="checkbox-inline ">
                      @foreach($permissions as $permission)
                          <label class="checkbox checkbox-lg col-3">
                              <input type="checkbox" name="permissions[]" value="{{$permission->name}}"
                                     @isset($role)
                                     @foreach($role->permissions as $checkPermission)
                                     @if($permission->name == $checkPermission->name)
                                     checked
                                  @endif
                                  @endforeach @endisset />
                              <span></span>
                              {{ucfirst($permission->name)}}
                          </label>

                      @endforeach
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">{{isset($role)?'EDIT':'SUBMIT'}}</button>
              </form>





            <!--begin: Datatable-->
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}

{{--                        <th>ID</th>--}}
{{--                        <th>NAME</th>--}}
{{--                        <th>EMAIL</th>--}}
{{--                        <th>ACTION</th>--}}
{{--                        <th>CREATED AT</th>--}}
{{--                        <th>UPDATED AT</th>--}}



{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}

{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
            <!--end: Datatable-->
        </div>
    </div>

@endsection
