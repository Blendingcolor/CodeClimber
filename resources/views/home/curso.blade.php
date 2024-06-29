@guest
    <script>
        window.location.href = "/login";
    </script>
@else
    @extends('layouts/Content')
    @section('moduleContent')
        <!-- Contenido sub módulo -->
        <x-module.moduleContent :module="$modules" :existingMP="$existingMP" :course="$course" />

    @endsection
@endguest
