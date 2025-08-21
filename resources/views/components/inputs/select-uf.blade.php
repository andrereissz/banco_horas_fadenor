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

    @foreach ($estados as $uf => $label)
        <option value="{{ $uf }}" {{ $current === $uf ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
