<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\ModuleProfile;
use Illuminate\Support\Facades\Log;
class CheckCourseEnrollment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $cursoId = $request->route('curso');

        // Obtener el curso
        $curso = Course::find($cursoId);

        // Log para debugging
        Log::info('Middleware CheckCourseEnrollment', [
            'user_id' => $user->id,
            'curso_id' => $cursoId,
            'curso_exists' => $curso ? true : false
        ]);

        // Si el curso no existe, redirigir con un error
        if (!$curso) {
            return redirect()->route('catalogo')->with('error', 'El curso no existe.');
        }

        // Verificar si el curso es gratuito
        if ($curso->precio == 0) {
            return redirect()->route('catalogo')->with('info', 'Este curso es gratuito.');
        }

        // Verificar si el usuario ya está inscrito en el curso
        $profileId = $user->id;
        $isEnrolled = ModuleProfile::where('profile_id', $profileId)
                                   ->whereHas('module', function ($query) use ($cursoId) {
                                       $query->where('course_id', $cursoId);
                                   })->exists();

        Log::info('Enrollment check', [
            'is_enrolled' => $isEnrolled
        ]);

        if ($isEnrolled) {
            return redirect()->route('catalogo')->with('info', 'Ya estás inscrito en este curso.');
        }

        // Si no es gratuito y el usuario no está inscrito, permitir acceso
        return $next($request);
    }
}
