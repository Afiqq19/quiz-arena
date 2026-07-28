@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-fuchsia-500 text-start text-base font-medium text-fuchsia-400 bg-fuchsia-500/10 focus:outline-none focus:text-fuchsia-300 focus:bg-fuchsia-500/20 focus:border-fuchsia-400 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-white hover:bg-white/5 hover:border-gray-500 focus:outline-none focus:text-white focus:bg-white/10 focus:border-gray-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
