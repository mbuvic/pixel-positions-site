@props(['width' => 90, 'logoUrl' => ''])

<img {{ $attributes->merge(['class' => 'rounded-xl']) }} src="{{ $logoUrl }}" width="{{ $width }}" alt="">
