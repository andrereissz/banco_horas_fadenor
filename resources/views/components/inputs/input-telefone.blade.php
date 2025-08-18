@props(['disabled' => false])

<input @disabled($disabled) name={{ $name }} id={{ $id }} {{ $attributes->merge(['class' => $class ]) }} data-phone>

