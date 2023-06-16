@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/kothaform.css') }}">
@endsection

@section('content')
    <div class="row h-100 ml-0 main">

        <form action="{{ route('kotha.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container1">
                <div class="left">

                    {{ old('images[]') }}
                    <h6><span>Image</span></h6>

                    <small class="form-text text-danger">
                        @error('images')
                            {{ $message }}
                        @enderror
                    </small>
                    <label id="label-image" for="gallery-photo-add">
                        Select Images <br>
                        <i class="fa fa-2x fa-camera"></i>
                        <input type="file" name="images[]" id="gallery-photo-add" data-max-files="4" multiple />
                        <span id="imageName"></span> <br>
                    </label>
                    <div class="gallery"></div>
                </div>
                <div class="middle">
                    <h6><span>Description</span></h6>
                    <div class="form-group">
                        <textarea class="form-control" name="description" id="description" placeholder="description of kotha" rows="2">{{ old('description') }}</textarea>
                        <small class="form-text text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-1 col-form-label">Price </label>
                        <div class="col-md-11">
                            <input type="number" class="form-control" name="price" id="price"
                                value="{{ old('price') }}" placeholder="price per month">
                            <small class="form-text text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>

                    {{-- contact info --}}

                    <h6><span> Contact Details</span></h6>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="phone_no">Phone number </label>
                            <input type="number" class="form-control" name="phone_no" id="phone_no"
                                value="{{ old('phone_no') }}" placeholder="Phone number">
                            <small class="form-text text-danger">
                                @error('phone_no')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group col-8">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ old('email') }}" placeholder="Email">
                            <small class="form-text text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                    {{-- contact info end --}}

                    {{-- location info --}}
                    <h6><span> Location Details</span></h6>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="bedroom">District</label>
                            <select class="custom-select form-control" name="district" id="district">
                                @foreach ($NepalDistrict as $district)
                                    <option value="{{ $district }}">{{ $district }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="city">City </label>
                            <input type="text" class="form-control" name="city" id="city"
                                value="{{ old('city') }}" placeholder="City">
                            <small class="form-text text-danger">
                                @error('city')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="street">Street </label>
                            <input type="text" class="form-control" name="street" id="street"
                                value="{{ old('street') }}" placeholder="Street">
                            <small class="form-text text-danger">
                                @error('street')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                    </div>


                    {{-- location info end --}}

                    {{-- additional info start --}}
                    <h6><span> Flats Details</span></h6>
                    <div class="form-check">
                        <label class="form-check-label mb-2">
                            <input type="checkbox" class="form-check-input" name="additionalInfo" id="additionalInfo"
                                value="1">
                            Flats
                        </label>
                    </div>

                    <div class="additionalInfoDiv">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="bedroom" class="col-form-label">Bedroom</label>
                                <div class="form-group">
                                    <select class="custom-select" name="bedroom" id="bedroom">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="kitchen" class="col-form-label">Kitchen</label>
                                <div class="form-group">
                                    <select class="custom-select" name="kitchen" id="kitchen">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="livingroom" class="col-form-label">Livingroom</label>
                                <div class="form-group">
                                    <select class="custom-select" name="livingroom" id="livingroom">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="toilet" class="col-form-label">Bathroom</label>
                                <div class="form-group">
                                    <select class="custom-select" name="toilet" id="toilet">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-4 d-flex align-items-center">Parking
                                <label class="switch ml-3">
                                    <input type="checkbox" name='parking'>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-secondary w-100">Submit</button>
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
                                    value="{{ old('latitude') }}" id="nepal_kathmandu_latitude" min='-85'
                                    max="85" />
                                <small class="form-text text-danger">
                                    @error('latitude')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <label>Longitude :</label>
                                <input type="number" step="any" name="longitude" class="form-control"
                                    value="{{ old('latitude') }}" id="nepal_kathmandu_longitude" min='-180'
                                    max='180' />
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

    <script src="https://use.fontawesome.com/3a2eaf6206.js"></script>


    {{-- <script src="{{ asset('js/kothaform.js') }}"></script> --}}

    <script>
        var totalFileAmount = 0;
        // Multiple images preview in browser
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
        };

        $('#gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.gallery');
        });

        // additional info javascript start
        $('#additionalInfo').on('click', function() {
            if ($('#additionalInfo').is(":checked")) {
                $('.additionalInfoDiv').show();
            } else {
                $('.additionalInfoDiv').hide();
            }
        });
        // additional info javascript end

        // map javascript start
        $('#nepal_kathmandu').locationpicker({
            location: {
                latitude: {{ old('latitude') ? old('latitude') : '27.703756329401294' }},
                longitude: {{ old('longitude') ? old('longitude') : '85.3402138459412' }}
            },
            radius: 20,
            inputBinding: {
                latitudeInput: $('#nepal_kathmandu_latitude'),
                longitudeInput: $('#nepal_kathmandu_longitude')
            },
            enableAutocomplete: true,
            onchanged: function(currentLocation, radius, isMarkerDropped) {}
        });
        // map javascript end
    </script>
@endsection
