@props(['label', 'name'])

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="{{$name}}" name="{{$name}}">
    <label class="form-check-label" for="{{$name}}">{{$label}}</label>
</div>
