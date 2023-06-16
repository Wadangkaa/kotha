@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/mypost.css') }}">
@endsection

@section('content')

    @if ($myKothas->isEmpty())
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">You have not deleted any post yet</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @else
        @foreach ($myKothas as $kotha)
            <div class="post-container container-fluid pb-4 pt-4 mb-4 shadow table table-striped">
                <div class="row px-xl-5">
                    <div class="col-lg-3">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner bg-light">
                                <div class="carousel-item active">
                                    <img class="w-100 h-100"
                                        src="{{ asset('storage/uploads/' . $kotha->images->first()->image_url) }}"
                                        alt="Image">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <div class="descriptions col-lg-9 h-100">
                        <div class="row">
                            <div class="col">
                                <h3 class="font-weight-semi-bold">Description</h3>
                                <p class="mb-4">
                                    {{ $kotha->description }}
                                </p>
                            </div>
                            
                            <div class="col" style="max-width: 35%">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('trash.restore', ['id' => $kotha->id]) }}">
                                            <div class="icon">
                                                Restore
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('trash.delete', ['id' => $kotha->id]) }}">
                                            <div class="icon">
                                                Delete forever
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-between">
                            <div class="row">
                                <div class="col w-auto">
                                    <h5>Location</h5>
                                    <p><b>District: </b>{{ $kotha->location->district }}</p>
                                    <p><b>City: </b>{{ $kotha->location->city }}</p>
                                    <p><b>Street: </b>{{ $kotha->location->street }}</p>
                                </div>
                                <div class="col mw-35 " style="max-width: 35%">
                                    @if ($kotha->additionalInfo != null)
                                        <h5 align='center'>Flat</h5>
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Living Room: </b>{{ $kotha->additionalInfo->living_room }}</p>
                                                <p><b>Bedroom: </b>{{ $kotha->additionalInfo->bedroom }}</p>
                                                <p><b>Kitchen: </b>{{ $kotha->additionalInfo->kitchen }}</p>
                                            </div>
                                            <div class="col">
                                                <p><b>Bathroom: </b>{{ $kotha->additionalInfo->toilet }}</p>
                                                <p><b>Parking: </b>{{ $kotha->additionalInfo->parking }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <h3 class="font-weight-semi-bold price">Rs. {{ $kotha->price }}</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        <?php
        echo '<script>
            var longitude = ' .
            $kotha->map->longitude .
            ';
            var latitude = ' .
            $kotha->map->latitude .
            ';
            </script>';
        ?>
    @endif
@endsection





<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>


<script>
    jQuery(function($) {
        // Asynchronously Load the map API
        var script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
        document.body.appendChild(script);
    });

    function initialize() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };

        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);

        // Multiple Markers
        var markers = [
            ['London Eye, London', latitude, longitude]
        ];

        // Info Window Content

        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(),
            marker, i;

        // Loop through our array of markers & place each one on the map
        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });
            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Automatically center the map fitting all markers on the screen 
            map.fitBounds(bounds);
        }
        // Override our map zoom level once our fitBounds function runs(Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(14);
            google.maps.event.removeListener(boundsListener);
        });
    }
</script>
