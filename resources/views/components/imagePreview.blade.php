@props(['data'])

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 75%;" role="document">
        <div class="modal-content">
            <div class="modal-body">
                @foreach ($data->images as $image)
                    <img class="mt-3 mr-3" style="width:48%; height:350px; object-fit:cover;"
                        src="{{ asset('storage/uploads/' . $image->image_url) }}">
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
