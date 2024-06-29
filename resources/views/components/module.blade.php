<!-- Despliegue de módulos y submódulos -->
<div tabindex="0" id="moduleElements"
    class="p-2 text-lg transition-all duration-100 bg-gray-200 border rounded-sm modules-buttons lg:hover:translate-x-0 lg:hover:translate-y-1 bg-opacity-15 hover:bg-opacity-35 border-1 hover:rounded-md">
    <button id="moduleName" class="w-full module-button text-start" data-target="submodule-{{ $moduleId }}"
        data-id="{{ $moduleId }}">{{ $moduleName }}
    </button>
    <div id="submodule-{{ $moduleId }}" class="hidden">
        @for ($i = 0; $i < count($subModuleNames); $i++)
            <x-submodulo :subModuleId="$subModuleIds[$i]" :subModuleName="$subModuleNames[$i]" /> 
        @endfor
    </div>
</div>