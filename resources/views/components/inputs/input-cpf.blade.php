@props(['disabled' => false])

<input @disabled($disabled) name={{ $name }} id={{ $id }} value={{ $value }} @if($required) required @endif {{ $attributes->merge(['class' => $class ]) }} data-cpf>
