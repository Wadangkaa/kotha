@props(['data'])

<a href="{{ route('kotha.show', $data->id) }}"
    class="product-item card bg-transparent border-0 mb-4 rounded-lg p-2" style="color: #6C757D;">
    <div class="image-div">
        <img class="card-img-top rounded-lg"
            src="{{ asset('storage/uploads/' . $data->images->first()->image_url) }}"
            alt="Card image cap">
    </div>

    <div class="row details">
        <iconify-icon icon="ic:baseline-location-on" width='20' height='20'>
        </iconify-icon>

        <span class="card-text" style="text-align: left;">{{ $data->location->city }}
            ({{ $data->location->district }})
        </span>
    </div>
    <div class="row kotha-decription">
        <div class="col-8 pr-0 pl-0">
            @if ($data->additionalInfo != null)
                <div class="row">
                    <div class="d-inline">
                        <iconify-icon icon="mdi:bed-empty" width='20' height='20'>
                        </iconify-icon>Bedroom: {{ $data->additionalInfo->bedroom }}
                    </div>
                    <div class="d-inline ml-3">
                        <iconify-icon icon="tabler:tools-kitchen-2" width='20' height='20'>
                        </iconify-icon>Kitchen: {{ $data->additionalInfo->kitchen }}
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div>
                        <div class="d-inline">
                            <iconify-icon icon="mdi:sofa" width='20' height='20'>
                            </iconify-icon>Hall: {{ $data->additionalInfo->living_room }}
                        </div>
                        <div class="d-inline ml-3">
                            <iconify-icon icon="fluent-mdl2:parking-location-mirrored" width='20'
                                height='20'>
                            </iconify-icon>Parking: {{ $data->additionalInfo->parking }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-4 pr-0 pl-0 d-flex align-items-end justify-content-end">
            <span>Rs. {{ $data->price }}</span>
        </div>
    </div>
</a>