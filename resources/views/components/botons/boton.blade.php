@props(['clases' => '', 'href'])

<a {{ $attributes->merge(['class' => 'duration-100 font-medium flex items-center justify-around rounded bg-[#18181B] mb-4 hover:border hover:border-[#FFFF44] ' . $clases]) }} href="{{$href}}">
    {{ $slot }}
</a>
