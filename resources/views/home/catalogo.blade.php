@extends('layouts.plantillaUser')
@section('title', 'HomeUser')
@section('menus')
{{-- Aca mas menus --}}
@endsection
@section('contenido')
<div class="contenido w-[90%] h-[80%] mt-20 mb-4 max-sm:mt-6">
    @auth
    <script>
        @if(session('success'))
            alert("{{ session('success') }}");
        @endif

        @if(session('error'))
            alert("{{ session('error') }}");
        @endif

        @if(session('info'))
            alert("{{ session('info') }}");
        @endif
    </script>
        @foreach ($courses as $course)
        {{-- <h2>{{$course->description}}</h2> --}}
            <x-targets.tarjetasStore href="{{ route('course.show', $course->id) }}" titulo="{{ $course->name }}" inscritos="20" iconCurso="{{ $course->image }}">
                @if(in_array($course->id, $CursoInscrito_id))
                    <h1 class="w-[50%] h-[2rem] absolute bottom-6 border border-[#FFFF44] bg-[#FFFF44] text-black hover:scale-105">Ya te inscribiste</h1>
                @else
                    <form action="{{ route('course.inscription', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-[50%] h-[2rem] absolute bottom-6 border border-[#FFFF44] bg-[#FFFF44] text-black hover:scale-105">Inscribirse</button>
                        
                    </form>
                @endif
            </x-targets.tarjetasStore>
        @endforeach
    @endauth

    @guest
        <p>Para ver el contenido inicia sesión <a href="login">login</a></p>
    @endguest
</div>
@endsection

{{-- @extends('layouts.plantillaUser')
@section('title', 'HomeUser')
@section('menus')

@endsection
@section('contenido')
<div class="contenido w-[90%] h-[80%] mt-20 mb-4 max-sm:mt-6">
    @auth
    <script>
        @if(session('success'))
            alert("{{ session('success') }}");
        @endif

        @if(session('error'))
            alert("{{ session('error') }}");
        @endif
    </script>
        @foreach ($courses as $course)
            <x-targetasStore href="{{ route('course.show', $course->id) }}" titulo="{{ $course->name }}" inscritos="20" iconCurso="{{ $course->image }}">
                @if(in_array($course->id, $CursoInscrito_id))
                    <h1 class="w-[50%] h-[2rem] absolute bottom-6 border border-[#FFFF44] bg-[#FFFF44] text-black hover:scale-105">Ya te inscribiste</h1>
                @else
                    <form action="{{ route('course.inscription', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-[50%] h-[2rem] absolute bottom-6 border border-[#FFFF44] bg-[#FFFF44] text-black hover:scale-105">Inscribirse</button>
                    </form>
                @endif
            </x-targetasStore>
        @endforeach
    @endauth

    @guest
        <p>Para ver el contenido inicia sesión <a href="login">login</a></p>
    @endguest
</div>
@endsection --}}
