@props(['name', 'values'])

<div class="col">
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>
        @foreach ($values as $value)
            <option value="{{ $value }}">
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>
