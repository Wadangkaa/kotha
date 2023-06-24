@props(['type' => 'text', 'name', 'placeholder'])

<div class="col"  {{ $attributes->merge(['class' => 'form-control']) }} style="padding-left: 0">
    <input type="{{$type}}" class="form-control" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" min="0"  {{ $attributes->merge(['class' => 'form-control']) }}>
</div>
