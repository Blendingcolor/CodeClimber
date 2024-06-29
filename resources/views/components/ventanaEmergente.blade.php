@props(['clases' => ''])

<div id="ventanaEmergente" {{ $attributes->merge(['class' => '' . $clases]) }}>
    {{ $slot }}
</div>
