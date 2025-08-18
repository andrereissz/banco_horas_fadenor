@props(['disabled' => false])

<input @disabled($disabled) name={{ $name }} id={{ $id }} @if($required) required @endif {{ $attributes->merge(['class' => $class ]) }} maxlength="14" placeholder="000.000.000-00" data-cpf>
