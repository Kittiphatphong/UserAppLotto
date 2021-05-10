@extends('layouts.newApp')
@section('title','Google map')
@section('header')

    <div class="d-flex align-items-baseline flex-wrap mr-5">

        <h5 class="text-dark font-weight-bold my-1 mr-5">MAPs PAGE</h5>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <span  class="text-muted">Maps</span>
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
        var data = {!!   json_encode($map_index->toArray()) !!};
        console.log(data);
        function initMap() {
            const myLatLng = {lat: 17.975, lng: 102.633}
            map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 10,
            });

            const image =
                "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";

            for (var i = 0 ; i<data.length; i++){
                var icon = {
                    url: data[i].partners.icon, // url
                    scaledSize: new google.maps.Size(25, 25), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };

                const contentString =
                    "<a href='https://www.google.com/maps/search/?api=1&query="+data[i].id+ " ' class='btn btn-link' target='_blank'><i class='fa fa-edit text-primary'></i></a>" +
                    "<div class='fontJ text-center p-0 m-0'>"+
                    "<img src='" + data[i].partners.icon +"' style='width: 50px'>" +
                    "<p>"+
                data[i].partners.partner_name +
                    "</p>" +
                    "<p>"
                    +data[i].name +"</p>" +
                    "<img src='" + data[i].image +"' style='width: 200px'>"+
                    "<br>"+
                    "<a href='https://www.google.com/maps/search/?api=1&query="+data[i].lat+","+data[i].lng+ " ' class='btn btn-link' target='_blank'>View on google map</a>" +
                    "</div>";

                const marker =new google.maps.Marker({
                    position: {lat: data[i].lat, lng: data[i].lng},
                    map,

                    icon:  icon,
                });
                let infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });
                map.addListener("click",()=>{
                    infowindow.close();
                });
                marker.addListener("click", () => {
                    infowindow.close();
                    infowindow.open(map, marker);

                });
            }

        }



    </script>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">New location
                    <span class="d-block text-muted pt-2 font-size-sm">All location of partner</span></h3>
            </div>
            <div class="card-toolbar">

                <a href="{{route('partner.create')}}" class="btn btn-primary font-weight-bolder mr-1">
                											<span class="svg-icon svg-icon-md">
                												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                										<i class="fa fa-user-friends"></i>
                                                                <!--end::Svg Icon-->
                											</span>New partner</a>
                <a href="{{route('google-map.create')}}" class="btn btn-outline-primary font-weight-bolder">
                											<span class="svg-icon svg-icon-md">
                												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                										<i class="fa fa-location-arrow"></i>
                                                                <!--end::Svg Icon-->
                											</span>New location</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="my-2">
            <!--begin::Nav Tabs-->
            <ul class="dashboard-tabs nav nav-pills nav-danger row row-paddingless m-0 p-0 flex-column flex-sm-row " role="tablist">
                <!--begin::Item-->
                @foreach($partners as $partner)
                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 @if($loop->last) mr-0 @else mr-3 @endif mb-3 mb-lg-0">
                    <a href="{{route('partner.edit',$partner->id)}}" class="nav-link border  d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" href="#tab_forms_widget_1">
															<span class="nav-icon py-2 w-auto">
																<span class="svg-icon svg-icon-3x">
                                                                   <img src="{{$partner->icon}}" height="100px">

																</span>
															</span>
                        <span class="nav-text font-size-lg py-1 font-weight-bold text-center">{{$partner->partner_name}}</span>
                    </a>
                </li>
                @endforeach




            </ul>


        </div>
    </div>
    <div id="map" style="width:100%;height:70%" class="table-responsive border border-light rounded card card-custom"></div>











<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJfH_cLg1v9qmB0ybZ7OaJlJxTLGGHx9o&callback=initMap&libraries=&v=weekly"
    async
></script>
@endsection
