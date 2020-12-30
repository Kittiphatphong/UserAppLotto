<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  action="{{route('customer.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>FIRST NAME</label>
                            <input type="text" class="form-control" name="firstname">
                        </div>
                        <div class="form-group">
                            <lable>LAST NAME</lable>
                            <input type="text" class="form-control" name="lastname">
                        </div>
                        <div class="form-group">
                            <lable>PHONE NO</lable>
                            <input type="number" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <lable>GENDER</lable>
                            <select class=" col-12" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <lable>BIRTHDAY</lable>
                            <input type="date" class="form-control" name="birthday">
                        </div>
                        <div class="form-group">
                            <lable>PASSWORD</lable>
                            <input type="password" name="password" class="form-control" autocomplete="off">
                        </div>
                        <button class="btn btn-success btn-block" type="submit"><strong>SUBMIT</strong></button>
                    </form>
                    <div class="mt-5">
                    Customer list
                    @foreach($customers as $customer)
                    <p>{{$customer->phone}} {{$customer->firstname}} {{$customer->lastname}} --
                    @foreach($customer->tokens as $token) {{$token->token}} @endforeach</p>
                        @endForeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
