@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/mypost.css') }}">
    <style>
        img {
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <x-alert />

    @if ($myKothas->isEmpty())
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">You do not have any post yet</h1>
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
                        <img class="w-100 h-100" src="{{ asset('storage/uploads/' . $kotha->images->first()->image_url) }}"
                            alt="Image">
                    </div>

                    <div class="col-lg-6 flex-column justify-content-between">
                        <div class="row">
                            <h3 class="font-weight-semi-bold">Description</h3>
                            <p class="mb-4">
                                {{ $kotha->description }}
                            </p>
                        </div>
                        <div class="row flex-column justify-content-end">
                            <h5 class="font-weight-bold">Location</h5>
                            <div class="mt-2"><span>District:</span>{{ $kotha->location->district }}</div>
                            <div class="mt-2"><span>City:</span>{{ $kotha->location->city }}</div>
                            <div class="mt-2"><span>Street:</span>{{ $kotha->location->street }}</div>
                        </div>
                    </div>

                    <div class="col-lg-3">

                        {{-- <div id='buttons' class="row justify-content-between">
                            <a href="{{ route('post.show', $post = $kotha->id) }}">
                                <div class="icon">
                                    <button type="button" class="btn btn-primary">View</button>
                                </div>
                            </a>
                            <a href="{{ route('post.edit', ['post' => $kotha]) }}">
                                <div class="icon">
                                    <button type="button" class="btn btn-info">Edit</button>
                                </div>
                            </a>
                            <form action="{{ route('post.destroy', ['post' => $kotha->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div> --}}

                        <div class="row justify-content-between">
                            <a class="btn btn-primary" href="{{ route('trash.restore', ['id' => $kotha->id]) }}">
                                <div class="icon">
                                    Restore
                                </div>
                            </a>
                            <a class="btn btn-danger" href="{{ route('trash.delete', ['id' => $kotha->id]) }}">
                                <div class="icon">
                                    Delete forever
                                </div>
                            </a>
                        </div>

                        <div class="row flex-column">
                            @if ($kotha->additionalInfo != null)
                                <h5 align='center'>Flat</h5>
                                <div class="row">
                                    <div class="col">
                                        <p><b>Living Room: </b>{{ $kotha->additionalInfo->living_room }}</p>
                                        <p><b>Bedroom: </b>{{ $kotha->additionalInfo->bedroom }}</p>
                                        <p><b>Kitchen: </b>{{ $kotha->additionalInfo->kitchen }}</p>
                                    </div>
                                    <div class="col text-right">
                                        <p><b>Bathroom: </b>{{ $kotha->additionalInfo->toilet }}</p>
                                        <p><b>Parking: </b>{{ $kotha->additionalInfo->parking }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row justify-content-end">
                            <h3 class="font-weight-semi-bold price">Rs. {{ $kotha->price }}</h3>
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




@section('scripts')
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
@endsection
