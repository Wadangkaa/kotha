@extends('layouts.guest')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/userperferences.css') }}">
@endsection

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Perferences</p>

        <form method="POST" action="{{ route('user.preferences.store') }}">
            @csrf

            <div class="mb-3">
                <div class="row mb-3">
                    <x-input-option name='user_perfered_district' :values="$NepalDistricts" />
                </div>

                <div class="row my-4">
                    <div class="col-9">
                        <label for="parking">Parking</label>
                    </div>
                    <div class="p-0">
                        <div class=" button r" id="button-1">
                            <input name='parking' type="checkbox" class="checkbox" />
                            <div class="knobs"></div>
                            <div class="layer"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="middle">
                        <div class="multi-range-slider">
                            <input type="range" id="input-left" min="0" max="100" value="25">
                            <input type="range" id="input-right" min="0" max="100" value="75">

                            <div class="slider">
                                <div class="track"></div>
                                <div class="range"></div>
                                <div class="thumb left"></div>
                                <div class="thumb right"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <span class="multi-range">
                        <input type="range" min="0" max="50" value="5" id="lower">
                        <input type="range" min="0" max="50" value="45" id="upper">
                    </span>
                </div>

                <div class="row">
                    <div class="col">
                        <x-input-label for='min_price' label='min_price' />
                        <x-input type="number" id='hello' name="min_price" placeholder="Min price" min=0 />
                    </div>
                    <div class="col">
                        <x-input-label for='min_price' label='min_price' />
                        <x-input type="number" name="max_price" placeholder="Max price" />
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col">
                    <a class="btn btn-info btn-block" href="{{ route('kotha.index') }}" role="button">Skip</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">Next</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/userperferences.js') }}"></script>
@endsection
