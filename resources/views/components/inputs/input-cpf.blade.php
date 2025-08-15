@php
  $inputId = $id ?? $name.'-'.uniqid();
@endphp

<div class="form-control">
  <label class="label" for="{{ $inputId }}">
    <span class="label-text">{{ $label }}@if($required) * @endif</span>
  </label>

  <input
    id="{{ $inputId }}"
    type="text"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    class="{{ $class }}"
    inputmode="numeric"
    autocomplete="off"
    data-cpf
    @if($required) required @endif
  >

  @error($name)
    <span class="text-error text-sm">{{ $message }}</span>
  @enderror
</div>
