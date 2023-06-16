@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/signupform.css') }}">
@endsection

@section('main-section')
    <div class="container-fluid d-flex justify-content-center">
        <div class="signupform  col-5 pb-3 shadow">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <h3 class="mb-3">Sign Up Form</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="fname" id="fname" value="{{ old('fname') }}"
                            placeholder="First Name">

                        <small class="form-text text-white">
                            @error('fname')
                                {!! str_replace('fname', 'first name', $message) !!}
                            @enderror
                        </small>

                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="lname" id="lname" value="{{ old('lname') }}"
                            placeholder="Last Name">
                        <small class="form-text text-white">
                            @error('lname')
                                {!! str_replace('lname', 'last name', $message) !!}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                        placeholder="Email">
                    <small class="form-text text-white">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </small>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <small class="form-text text-white">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </small>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                        placeholder="Confirm Password">
                    <small class="form-text text-white">
                        @error('confirm_password')
                            {{ $message }}
                        @enderror
                    </small>
                </div>

                <div id="user-preferences">
                    <div class="row">
                        <div class="col-6">
                            <select name="preferences_district" id="preferences_district">
                                <option value="Udayapur">Udayapur</option>
                                <option value="Udayapur">Kathmandu</option>
                                <option value="Lalitpur">Lalitpur</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="number" name="preferences_min_price" id="preferences_min_price">
                        </div>
                        <div class="col-3">
                            <input type="number" name="preferences_max_price" id="preferences_max_price">
                        </div> 
                    </div>

                    <div class="row">
                        <input type="checkbox" name="preferences_parking">Parking
                    </div>
                </div>

                <button type="submit" id="submit" class="btn btn-secondary w-100">Submit</button>

            </form>
        </div>
    </div>
@endsection
