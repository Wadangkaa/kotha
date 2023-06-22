@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/kothaform.css') }}">
@endsection

@section('content')
    <div class="row h-100 ml-0 main">

        <form action="{{ route('post.update', $post = $kotha) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container1">
                <div class="left">
                    <h6><span>Image</span></h6>
                    <div class="gallery">
                        @foreach ($kotha->images as $image)
                            <img src="{{ asset('storage/uploads/' . $image['image_url']) }}" class="rounded mx-auto d-block"
                                alt="...">
                        @endforeach
                    </div>
                </div>
                <div class="middle">
                    <h6><span>Description</span></h6>
                    <div class="form-group">
                        <textarea class="form-control" name="description" id="description" placeholder="description of kotha" rows="2">{{ $kotha->description }}</textarea>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-1 col-form-label">Price </label>
                        <div class="col-md-11">
                            <input type="number" class="form-control" name="price" id="price"
                                value="{{ $kotha->price }}" placeholder="price per month">
                        </div>
                    </div>

                    {{-- contact info --}}

                    <h6><span> Contact Details</span></h6>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="phone_no">Phone number </label>
                            <input type="number" class="form-control" name="phone_no" id="phone_no"
                                value="{{ $kotha->contact->phone_no }}" placeholder="Phone number">
                        </div>

                        <div class="form-group col-8">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $kotha->contact->email }}" placeholder="Email">
                        </div>
                    </div>
                    {{-- contact info end --}}

                    {{-- location info --}}
                    <h6><span> Location Details</span></h6>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="district">District </label>
                            <input type="text" class="form-control" name="district" id="district"
                                value="{{ $kotha->location->district }}" placeholder="District">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="city">City </label>
                            <input type="text" class="form-control" name="city" id="city"
                                value="{{ $kotha->location->city }}" placeholder="City">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="street">Street </label>
                            <input type="text" class="form-control" name="street" id="street"
                                value="{{ $kotha->location->street }}" placeholder="Street">
                        </div>

                    </div>
                    {{-- location info end --}}

                    {{-- additional info start --}}
                    @if (isset($kotha->additionalInfo))
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="bedroom" class="col-form-label">Bedroom</label>
                                <div class="form-group">
                                    <select class="custom-select" name="bedroom" id="bedroom">
                                        <option value="1" {!! $kotha->additionalInfo->bedroom == 1 ? 'selected' : '' !!}>1</option>
                                        <option value="2" {!! $kotha->additionalInfo->bedroom == 2 ? 'selected' : '' !!}>2</option>
                                        <option value="3" {!! $kotha->additionalInfo->bedroom == 3 ? 'selected' : '' !!}>3</option>
                                        <option value="4" {!! $kotha->additionalInfo->bedroom == 4 ? 'selected' : '' !!}>4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="kitchen" class="col-form-label">Kitchen</label>
                                <div class="form-group">
                                    <select class="custom-select" name="kitchen" id="kitchen">
                                        @if ($kotha->additionalInfo->kitchen == 1)
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                        @else
                                            <option value="1">1</option>
                                            <option value="2" selected>2</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="livingroom" class="col-form-label">Livingroom</label>
                                <div class="form-group">
                                    <select class="custom-select" name="livingroom" id="livingroom">
                                        @if ($kotha->additionalInfo->living_room == 1)
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                        @else
                                            <option value="1">1</option>
                                            <option value="2" selected>2</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="toilet" class="col-form-label">Bathroom</label>
                                <div class="form-group">
                                    <select class="custom-select" name="toilet" id="toilet">
                                        <option value="1" {!! $kotha->additionalInfo->toilet == 1 ? 'selected' : '' !!}>1</option>
                                        <option value="2" {!! $kotha->additionalInfo->toilet == 2 ? 'selected' : '' !!}>2</option>
                                        <option value="3" {!! $kotha->additionalInfo->toilet == 3 ? 'selected' : '' !!}>3</option>
                                        <option value="4" {!! $kotha->additionalInfo->toilet == 4 ? 'selected' : '' !!}>4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-4 d-flex align-items-center">Parking
                                <label class="switch ml-3">
                                    <input type="checkbox" name='parking'
                                        {{ $kotha->additionalInfo->parking == 'Yes' ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <button type="submit" class="btn btn-secondary w-100">Update</button>
                    </div>

                </div>

                <div class="right">
                    {{-- map info start --}}
                    <h6><span>Map</span></h6>
                    <div class="mapDiv">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label">Latitude :</label>
                                <input type="number" step="any" name="latitude" class="form-control"
                                    value="{{ old('latitude') }}" id="nepal_kathmandu_latitude" />
                                <small class="form-text text-danger">
                                    @error('latitude')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <label>Longitude :</label>
                                <input type="number" step="any" name="longitude" class="form-control"
                                    value="{{ old('latitude') }}" id="nepal_kathmandu_longitude" />
                                <small class="form-text text-danger">
                                    @error('longitude')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>

                        <!-- map -->
                        <div id="nepal_kathmandu" style="height: 389px;"></div>
                    </div>

                    {{-- map info end --}}
                </div>
            </div>
        </form>

    </div>
@endsection


@section('scripts')
    <!-- Optional JavaScript -->
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
    <script src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src='https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js'></script>

    {{-- map script end --}}


    <script>
        $('#nepal_kathmandu').locationpicker({
            location: {
                latitude: {{ $kotha->map->latitude }},
                longitude: {{ $kotha->map->longitude }}
            },
            radius: 20,
            inputBinding: {
                latitudeInput: $('#nepal_kathmandu_latitude'),
                longitudeInput: $('#nepal_kathmandu_longitude')
            },
            enableAutocomplete: true,
            onchanged: function(currentLocation, radius, isMarkerDropped) {}
        });

        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;

                totalFileAmount += filesAmount;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                            placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

            if (totalFileAmount >= 4) {

                console.log('four file selected')
                $('#label-image').hide();
            }

        };
    </script>
@endsection
