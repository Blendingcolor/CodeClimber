@extends('layouts.plantillaUser')
@section('title', 'HomeUser')
@section('menus')
@endsection
@section('contenido')
<div class="contenido w-[80%] h-[80%] mt-20 mb-4 max-sm:mt-6">
    @auth
    @foreach ($courses as $course)
            @php //codigo de php
                $firstModule = $course->modules->first();
                $moduleProfile = App\Models\ModuleProfile::where('module_id', $firstModule->id)->first();
            @endphp
            <x-targets.tarjetasCurso titulo="{{ $course->name }}" cantidadModulos="{{ $course->modules->count() }}" cantidad="" href="{{ route('course.show', $course->id) }}" hrefName="Módulos" urlBg="{{ $course->image }}" /> 
            <h1>Inicio: {{ $moduleProfile->start_date }}</h1>
            <h1>Fin: {{ $moduleProfile->end_date }}</h1>
    @endforeach
    <x-targets.tarjetasPlus href="{{ route('catalogo') }}"></x-targets.tarjetasPlus>
</div>
@endauth
@endsection

{{-- @extends('layouts.plantillaUser')
@section('title', 'HomeUser')
@section('menus')
@endsection
@section('contenido')
<div class="contenido w-[80%] h-[80%] mt-20 mb-4 max-sm:mt-6">
    @auth
    @foreach ($courses as $course)
        <x-targetasCurso titulo="{{ $course->name }}" cantidadModulos="{{ $course->modules->count() }}" cantidad="12" href="{{ route('course.show', $course->id) }}" hrefName="Módulos" urlBg="{{ $course->image }}" />
    @endforeach
    <x-targetasPlus href="{{ route('catalogo') }}"></x-targetasPlus>
</div>
@endauth
<x-bot></x-bot>
@endsection --}}



{{-- <div class="contenido w-[90%] h-[80%] mt-20 mb-4 max-sm:mt-6">
    @auth


    @endauth
    @foreach ($courses as $course)

        <x-targetasStore href="{{ route('course.show', $course->id) }}" titulo="{{ $course->name }}" inscritos="20" iconCurso="/images/html5.png">
            {{$course->description}}
        </x-targetasStore>
    @endforeach
    @guest
        <p>Para ver el contenido inicia sesion<a href="login">login</a></p>
    @endguest
</div> --}}

    {{-- <h1>Home</h1>
    @auth
        <p>Bienvenido {{auth()->user()->username}},estas autenticado, para salir presiona <a href="/logout">logout</a></p>  
        <a href="/">login</a>
    @endauth
        @foreach ($courses as $course)
            <li>
                <a href="{{route('course.show', $course->id)}}"> {{ $course->name }} </a>
            </li>
        @endforeach
    @guest
        <p>Para ver el contenido inicia sesion<a href="login">login</a></p>
    @endguest --}}