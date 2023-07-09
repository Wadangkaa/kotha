@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <style>
        #detail-image {
            height: inherit;
            width: inherit;
        }

        #map_canvas {
            height: 23rem;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid pt-4 single-kotha-detail">
        <div class="row">
            <div class="col-5">
                <img id="detail-image" src="{{ asset('storage/uploads/' . $kotha->images->first()->image_url) }}"
                    alt="Image">
            </div>

            <div class="col-7 px-4">
                <div class="row flex-column">
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-semi-bold">Description</h3>
                        </div>
                        <div class="col text-right">
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#exampleModalLong">
                                Images
                            </button>
                            <a name="approve" id="approve" class="btn btn-primary"
                                href="{{ route('admin.kotha.approve', $kotha) }}" role="button">Approved</a>
                            <a name="reject" id="reject" class="btn btn-danger"
                                href="{{ route('admin.kotha.reject', $kotha) }}" role="button">Reject</a>
                        </div>
                    </div>
                    <p class="mb-4">
                        {{ $kotha->description }}
                    </p>
                </div>

                <div class="d-flex flex-column align-items-between">
                    <div class="row">
                        <div class="col">
                            <h5>Location</h5>
                            <p><b>District: </b>{{ $kotha->location->district }}</p>
                            <p><b>City: </b>{{ $kotha->location->city }}</p>
                            <p><b>Street: </b>{{ $kotha->location->street }}</p>
                        </div>
                        <div class="col">
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
                    </div>

                    <div class="row justify-content-end">
                        <h3 class="font-weight-semi-bold price">Rs. {{ $kotha->price }}</h3>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="col-lg-4 h-auto"> --}}
        <div id="map_canvas" class="mapping my-3"></div>
        {{-- </div> --}}
    </div>
    <!-- Shop Detail End -->





    <x-imagePreview :data="$kotha"/>

    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 75%;" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @foreach ($kotha->images as $image)
                    <img class="mt-3 mr-3" style="width:48%; height:350px; object-fit:cover;" src="{{asset('storage/uploads/' . $image->image_url)}}">
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection
