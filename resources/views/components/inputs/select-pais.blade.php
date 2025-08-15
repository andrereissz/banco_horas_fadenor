@php
  $fieldId = $id ?? $name;
  $current = old($name, $selected);
@endphp

<select
    name="{{ $name }}"
    id="{{ $fieldId }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => $class]) }}
>
    <option value="" disabled {{ $current === '' ? 'selected' : '' }}>
        {{ $placeholder }}
    </option>

    @foreach ($countries as $code => $label)
        <option value="{{ $code }}" {{ $current === $code ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
