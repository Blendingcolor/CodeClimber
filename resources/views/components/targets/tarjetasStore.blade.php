@props(['clases' => '','href' ,'titulo', 'inscritos', 'iconCurso'])

<div class="targetasHome rounded-[10px] bg-[#18181B] relative flex flex-col">
    {{-- bg-cover relative bg-center --}}
    <div class=" w-full h-[12rem] rounded-[20px] flex justify-center items-center">
        <img class="h-[95%]" src="{{ $iconCurso }}" alt="">
    </div>
    <div class="w-full flex flex-col items-center justify-center border-t-2 border-[#8C8C8D]">
        <h2 class="mb-1 font-extrabold">{{ $titulo }}</h2>
        <div class="flex items-center justify-center w-full">
            <p class="w-10/12 text-[0.8rem] text-center">{{$slot}}</p>
        </div>
        <div class="absolute flex items-center justify-between w-full bottom-2">
            <div class="w-[50%] flex justify-start items-center">
                <i class="ml-3 bi bi-people-fill"></i>
                <h3 class="ml-3">{{$inscritos}}</h3>
            </div>
            <div class="w-[50%] flex justify-around items-center">
                <i class="text-[#FFFF44] bi bi-star-fill"></i>
                <i class="text-[#FFFF44] bi bi-star-fill"></i>
                <i class="text-[#FFFF44] bi bi-star-fill"></i>
                <i class="text-[#FFFF44] bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
        </div>
    </div>
</div>
