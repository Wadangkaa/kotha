@extends('layouts.guest')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Perferences</p>

        <form method="POST" action="{{ route('user.preferences.store') }}">
            @csrf

            <div class="mb-3">
                <div class="row mb-3">
                    <x-input-option name='user_perfered_district' :values="$NepalDistricts" />
                    <x-input-switch label="Parking" name='parking' />
                </div>
                <div class="row">
                    <x-input type="number" name="min_price" placeholder="Min price" min=0/>
                    <x-input type="number" name="max_price" placeholder="Max price" />
                </div>
               
            </div>

            <div class="row">
                <div class="col">
                    <a class="btn btn-info btn-block" href="{{route('kotha.index')}}" role="button">Skip</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">Next</button>
                </div>
            </div>
        </form>
    </div>
@endsection
