@extends('layouts.newApp')
@section('title','New location')

@section('header')
    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">MAP PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="#" class="text-muted">New location</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('google-map.index')}}" class="text-muted">Index</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection


@section('content')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script>
        let map;
        let edit = {!!   isset($edit)?json_encode($edit->toArray()) : json_encode(null) !!} ;

        function initMap() {
            let myLatLng = {lat: 17.975, lng: 102.633}
            if(edit != null){
                myLatLng = {lat: edit.lat , lng: edit.lng}
            }

            map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 15,
            });
            let marker = new google.maps.Marker({
                position:myLatLng,
                map
            });
            map.addListener("click", (mapsMouseEvent) => {
                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: mapsMouseEvent.latLng,
                    map
                });
                document.getElementById("lat").value = mapsMouseEvent.latLng.toJSON().lat;
                document.getElementById("lng").value = mapsMouseEvent.latLng.toJSON().lng;
            });
        }

        function setPin() {

            var lat = Number(document.getElementById("lat").value);
            var lng = Number(document.getElementById("lng").value);

            let marker = new google.maps.Marker();
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: lat, lng: lng},
                zoom: 15,
            });
            map.addListener("click", (mapsMouseEvent) => {
                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: mapsMouseEvent.latLng,
                    map
                });
                document.getElementById("lat").value = mapsMouseEvent.latLng.toJSON().lat;
                document.getElementById("lng").value = mapsMouseEvent.latLng.toJSON().lng;
            });
            marker.setMap(null);
            marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map
            });

        }

    </script>





    <div class="rounded container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200 pb-4">
                    <div class="card-title">
                        <h3 class="card-label">{{isset($edit)?'Edit':'New'}} location
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
<form action="{{isset($edit)?route('google-map.update',$edit->id):route('google-map.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @isset($edit)
        @method('PATCH')
    @endisset
    <div class="form-group">
        <label>Location</label>
        <div id="map" style="width:100%;height:500px" class="border border-light rounded"></div>
    </div>
    <div class="form-group">
        <label>Provinces</label>
        <select class="form-control" name="pr_id">
            @foreach($provinces as $province)
            <option value="{{$province->id}}" @isset($edit) @if($edit->provinces->id == $province->id) selected  @endif @endisset>{{$province->pr_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="{{isset($edit)?$edit->name:''}}" required>
    </div>
    <div class="form-group">
        <lable>Image</lable>
        <input type="file" name="image" class="form-control" >
        @isset($edit)

                <img src="{{$edit->image}}" class="mt-4 border rounded" width="200px">

        @endif
    </div>
    <div class="form-group">
        <label>Partner</label>
        <select class="form-control" name="partner_id">
            @foreach($partners as $partner)
            <option value="{{$partner->id}}" @isset($edit) @if($partner->id == $edit->partners->id) selected @endif  @endisset>{{$partner->partner_name}}</option>
            @endforeach
        </select>
    </div>
        <div class="form-group">
            <lable>Latitude</lable>
            <input type="text" name="lat"  id="lat" class="form-control" value={{isset($edit)?$edit->lat : 17.975}} onchange="setPin()">
        </div>
    <div class="form-group">
        <lable>Longitude</lable>
        <input type="text" name="lng"  id="lng" class="form-control" value={{isset($edit)?$edit->lng : 102.633}} onchange="setPin()">
    </div>




    <div class="form-group">
        <button type="submit" class="btn {{isset($edit)?'btn-warning':'btn-success'}} btn-block">{{isset($edit)?'EDIT':'SUBMIT'}}</button>
    </div>


</form>


                </div>
            </div>
        </div>
    </div>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJfH_cLg1v9qmB0ybZ7OaJlJxTLGGHx9o&callback=initMap&libraries=&v=weekly"
        async
    ></script>
@endsection
