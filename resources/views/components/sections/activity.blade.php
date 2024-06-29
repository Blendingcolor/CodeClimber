<div class="flex flex-col space-y-4">
    <h2 id="{{$sectionId}}" class="text-xl font-bold text-start">{{ $sectionName }}</h2>
    <div id="sectionContent" class="flex flex-col justify-between text-sm border-t-2 text-start border-white/5"> <br>
        <p>{{ $sectionContent }}</p>
        <button class="hover:text-sky-700 hover:underline"onclick="openCodeEditor()" target="_blank">Demo en nueva pestaña</button>
    </div>
</div>
