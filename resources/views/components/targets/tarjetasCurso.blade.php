@props(['clases' => '', 'href' ,'titulo', 'cantidadModulos', 'cantidad', 'hrefName', 'urlBg'])

<div class="targetasHome rounded-[10px] bg-[#18181B] flex flex-col">
    {{-- bg-cover relative bg-center --}}
    <div class=" w-full h-[12rem] rounded-[20px] flex justify-center items-center">
        <img class="h-[95%]" src="{{ $urlBg }}" alt="">
    </div>
    <div class="w-full flex flex-col items-center justify-center border-t-2 border-[#8C8C8D]">
        <h2 class="mb-1">{{ $titulo }}</h2>
        <a {{ $attributes->merge(['class' => 'duration-100 font-medium flex items-center justify-center rounded bg-[#18181B] mb-4 border w-[80%] border-[#8C8C8D] hover:border-[#BABABB] h-12 text-[#8C8C8D] hover:text-[#BABABB] flex flex-wrap justify-around' . $clases]) }} href="{{ $href }}">
            {{ $hrefName }}
        </a>
        <div class="w-full flex flex-row items-center justify-around mb-4">
            <p>Modulos:</p>
            <p>{{ $cantidadModulos }}</p>
        </div>
        <p class="text-[#FFFF44] text-3xl">{{ $cantidad }}</p>
    </div>
</div>
