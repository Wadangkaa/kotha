<style>
    .filter {
        width: 220px;
        height: 100vh;
        position: sticky;
        padding: 0 1rem;
    }

</style>
<link rel="stylesheet" href="{{ asset('css/userperferences.css') }}">

<div class="filter">
    <div class="heading">
        <h3>Filter</h3>
    </div>
    <form action="{{ route('kotha.filter') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="district">District</label>
            <select class="form-control form-control-sm" name="district" id="district">
                <option disabled hidden selected>Select District</option>
                @foreach ($NepalDistrict as $district)
                    <option value="{{ $district }}"
                    @if (isset($selectedDistrict))
                    @if ($district == $selectedDistrict)
                        selected
                    @endif
                    @endif>{{ $district }}</option>
                @endforeach
            </select>
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
                <x-input type="number" id='hello' name="min_price" placeholder="Min price" min=0 style="font-size: 12px; padding: 0px 2px 0px 10px;"/>
            </div>
            <div class="col">
                <x-input-label for='min_price' label='min_price' />
                <x-input type="number" name="max_price" placeholder="Max price" style="font-size: 12px; padding: 0px 2px 0px 10px;"/>
            </div>
        </div>

        <button class="btn btn-info mt-3 text text-right" type="submit">Filter</button>
    </form>
</div>

<script src="{{ asset('js/userperferences.js') }}"></script>
