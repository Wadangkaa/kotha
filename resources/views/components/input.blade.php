@props(['type' => 'text', 'name', 'placeholder'])

<div class="col">
    <input type="{{$type}}" class="form-control" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" min="0">
</div>
