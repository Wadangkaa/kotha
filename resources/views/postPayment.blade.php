@extends('layouts.main')

<style>
    .icon {
        color: white;
        background: #406bd7;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }

    .icon:hover {
        cursor: pointer;
        background: #6a8adb;
    }
</style>

@section('main-section')
    <div class="container-fluid pb-5 pt-5 mt-5 mb-4">
        <div class="row px-xl-5">
            {{-- <div class="col-lg-8 h-100 bg-light shadow">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-semi-bold">Description</h3>
                        <p class="mb-4">
                            {{ $request['description'] }}
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-between">
                    <div class="row">
                        <div class="col w-auto">
                            <h5>Location</h5>
                            <p><b>District: </b>{{ $request['district'] }}</p>
                            <p><b>City: </b>{{ $request['city'] }}</p>
                            <p><b>Street: </b>{{ $request['street'] }}</p>
                        </div>
                        <div class="col mw-35 " style="max-width: 35%">
                            @if ($request['additionalInfo'] != null)
                                <h5 align='center'>Flat</h5>
                                <div class="row">
                                    <div class="col">
                                        <p><b>Living Room: </b>{{ $request['livingroom'] }}</p>
                                        <p><b>Bedroom: </b>{{ $request['bedroom'] }}</p>
                                        <p><b>Kitchen: </b>{{ $request['kitchen'] }}</p>
                                    </div>
                                    <div class="col">
                                        <p><b>Bathroom: </b>{{ $request['toilet']}}</p>
                                        <p><b>Parking: </b>{{ $request['parking'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row" style="bottom: 0; text-align-last: right;">
                        <h3 class="font-weight-semi-bold price" style="float: right;">Rs. {{ $request['price']}}</h3>
                    </div>
                </div>

            </div> --}}

            <div class="col col-4 shadow">
                    <form action="{{route('esewa')}}" method="POST">
                        @csrf
                    <input class="btn btn-primary" value="Pay with esewa Rs 35" type="submit">
                    </form>
            </div>
        </div>
    </div>
@endsection


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
