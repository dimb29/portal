@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex flex-row py-2 px-2 my-1 rounded cursor-pointer text-white bg-blue-500 hover:bg-blue-600'
            : 'flex flex-row py-2 px-2 my-1 rounded cursor-pointer text-gray-300 hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
