@extends('layouts.newApp')
@section('title','Customer List')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">REGISTER USER PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">USERS</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('users.create')}}" class="text-muted">Register</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')
    <div class="rounded">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="float-right">

                        <!--begin::Button-->
                        <a href="{{route('users.index')}}" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>User list</a>
                        <!--end::Button-->
                    </div>
                    <div class="card-title">
                        <h3 class="card-label">{{isset($user)?'EDIT':'REGISTER'}}
                            <span class="d-block text-muted pt-2 font-size-sm">{{isset($user)?'Edit user':'Register new user'}}</span></h3>

                    </div>
                    <form  action="{{isset($user)?route('users.update',$user_register->id):route('users.store')}}" method="post">
                        @csrf
                        @isset($user)
                            @method('PUT')
                        @endisset
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full form-control" type="text" name="name" value="{{old('name',$user_register->name)}}" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4 form-group">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" value="{{old('email',$user_register->email)}}" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full form-control"
                                     type="password"
                                     name="password"
                                      autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full form-control"
                                     type="password"
                                     name="password_confirmation"  />
                        </div>
                        <div class="mt-4">
                            <select class="form-control" name="role">
                                <option disabled selected>Select role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}"
                                        @if($user_register->roles->count()>=1) @if($role->name==$user_register->roles->first()->name) Selected @endif @endif>
                                    {{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mt-4">
                            <x-button class="btn btn-block py-2">
                               {{isset($user)?'EDIT':'REGISTER'}}
                            </x-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection







