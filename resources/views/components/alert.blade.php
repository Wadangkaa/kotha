@if (session()->has('success'))
    <div id='alert' class="row alert alert-success alert-dismissible fade show position-fixed"
        style="z-index: 1; right: 0;" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {{ Session::forget('success') }}
@endif
@if (session()->has('error'))
    <div id='alert' class="row alert alert-danger alert-dismissible fade show position-fixed"
        style="z-index: 1; right: 0;" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {{ Session::forget('error') }}
@endif
