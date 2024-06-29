<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\ModuleProfile;
use App\Models\Profile;
use App\Models\Module;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $profile = Profile::find(auth()->user()->id);
        $ModuloInscrito = ModuleProfile::where('profile_id', $profile->id)->pluck('module_id')->toArray();
        $CursoInscrito_id = Module::whereIn('id', $ModuloInscrito)->pluck('course_id')->toArray();

        return view('home.catalogo', compact('courses', 'CursoInscrito_id'));
    }
    public function inscription(Request $request, $course_id)
{
    $request->validate([
        'course_id' => 'exists:courses,id',
    ]);

    $user = auth()->user();
    $profile = Profile::where('user_id', $user->id)->first();
    $course = Course::find($course_id);

    if (!$course) {
        return redirect()->route('catalogo')->with('error', 'El curso no existe.');
    }

    $module = Module::where('course_id', $course_id)->first();
    $isEnrolled = ModuleProfile::where('profile_id', $profile->id)
                                ->where('module_id', $module->id)
                                ->exists();

    if ($isEnrolled) {
        return redirect()->route('catalogo')->with('info', 'Ya está inscrito en este curso.');
    }

    if ($course->precio == 0) {
        if ($module) {
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addDays($course->period);

            ModuleProfile::create([
                'module_id' => $module->id,
                'profile_id' => $profile->id,
                'exam_status' => 'pending',
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            return redirect()->route('catalogo')->with('success', 'Inscripción realizada con éxito.');
        } else {
            return redirect()->back()->with('error', 'No se encontró el módulo del curso seleccionado o ya esta inscrito.');
        }
    } else {
        return redirect()->route('comprarcurso', [$course_id]);
    }
}
}
