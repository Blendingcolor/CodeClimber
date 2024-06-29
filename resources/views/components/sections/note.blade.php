<div class="flex flex-col items-center w-full">
    <div class="relative w-5/6 p-4 border-2 rounded-md bg-white/5 border-white/5">
        <h1 id="{{$sectionId}}" class="flex flex-row items-center justify-center text-xl font-bold text-center">{{$sectionName}}
        </h1>
        <div id="sectionContent" class="flex flex-col justify-between text-sm"> <br>
            <p>{{$sectionContent}}</p> 
            <br>
            <div class="flex justify-center w-full">
                <img class="flex justify-center w-80" src="{{$sectionImage}}"
                    alt="imagen">
            </div>
        </div>
        <div class="absolute top-[-15px] left-[-15px] w-10">
            <img class="hover:cursor-help" src="{{ asset('images/icons/information.svg') }}" alt="informationIcon">
        </div>
    </div>
</div>
