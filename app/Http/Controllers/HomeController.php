<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Alternative;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\ModuleProfile;
use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\PreguntaClasificatoria;
use App\Models\RespuestaClasificatoria;
use App\Models\RespuestaRespondidaClasificatoria;
use App\Models\ClasificatorioUsuario;

class HomeController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->profile->modules()->with('course')->get()->pluck('course')->unique();

        return view('home.homeUsuario', compact('courses'));
    }

    public function indexC()
    {
        $courses = Course::paginate();

        return view('/home', compact('courses'));
    }

    public function show($courseId, Course $curso, Module $module, Exam $exam)
    {
        $course = Course::with(['modules.sections','modules.sections.content', 'modules.exam'])->find($courseId);

        if (!$course) {
            return redirect()->back()->with('error', 'Curso no encontrado');
        }

        $modules = $course->modules;
        $profile = Profile::find(auth()->user()->id);
        $v_proyect = Project::where('profile_id', $profile->id)->where('course_id', $course->id)->exists();
        $modulesD = [];
        $allModulesApproved = true;
        
        foreach ($course->modules as $module) {
            $existingMP = ModuleProfile::where('module_id', $module->id)
                ->where('profile_id', $profile->id)
                ->exists();
            $verifyeExam = ModuleProfile::where('module_id', $module->id)
                ->where('profile_id', $profile->id)
                ->first();
    
            $isAccessible = $existingMP ? $verifyeExam->exam_status === 'Aprobado' : false;
            
            if (!$isAccessible) {
                $allModulesApproved = false;
            }
    
            $modulesD[] = [
                'module' => $module,
                'accessible' => $existingMP,
                'exam' => $module->exam
            ];
        }

        $existingMP = ModuleProfile::where('module_id', $module->id)
            ->where('profile_id', $profile->id)
            ->where('exam_status', 'Aprobado')
            ->exists();

        return view('home.curso', compact('course', 'modules', 'modulesD', 'existingMP', 'exam', 'allModulesApproved', 'v_proyect'))
            ->with('jsonData', [
                'course' => $course,
                'modulesD' => $modulesD,
                'module' => $modules,
                'exam' => $exam,
                'allModulesApproved' => $allModulesApproved
            ]);
    }

    public function showC()
    {
        return view('index');
    }


    public function showQuestion(Course $course, Module $module, Exam $exam, $index)
    {
        $questions = $exam->questions;
        $allQuestions = $questions->count();
        $question = $questions->get($index - 1);

        return view('exam.question', compact('course', 'module', 'exam', 'question', 'index', 'allQuestions'));
    }

    public function submitQuestion(Request $request, Course $course, Module $module, Exam $exam, $index)
{
    $request->validate([
        'alternative_id' => 'required',
    ]);

    $profile = auth()->user()->profile;
    $tiempo = ModuleProfile::where('profile_id', $profile->id)->get()->first();
    $selectedAlternative = Alternative::find($request->input('alternative_id'));

    if (!$selectedAlternative) {
        return redirect()->back()->withErrors('Alternative not found.');
    }

    $correctAnswer = $selectedAlternative->answer->answer;
    $isCorrect = $selectedAlternative->alternative === $correctAnswer;

    if (!session()->has('score')) {
        session(['score' => 0]);
    }

    if ($isCorrect) {
        session(['score' => session('score') + 1]);
    }

    $questions = $exam->questions;
    $allQuestions = $questions->count();

    if ($request->has('finish')) {
        $finalScore = session('score');
        $status = $finalScore > ($allQuestions / 2) ? 'Aprobado' : 'Desaprobado';

        if ($status === 'Aprobado') {
            // Actualizar el 'exam_status' del módulo actual a 'Aprobado'
            $currentModuleProfile = ModuleProfile::where('module_id', $module->id)
                ->where('profile_id', $profile->id)
                ->first();

            if ($currentModuleProfile) {
                $currentModuleProfile->exam_status = 'Aprobado';
                $currentModuleProfile->save();
            }

            $nextModule = Module::where('course_id', $course->id)
                ->where('id', '>', $module->id)
                ->orderBy('id', 'asc')
                ->first();

            if ($nextModule) {
                // Crear un nuevo registro de ModuleProfile para el siguiente módulo con 'exam_status' 'pending'
                ModuleProfile::create([
                    'module_id' => $nextModule->id,
                    'profile_id' => $profile->id,
                    'exam_status' => 'pending',
                    'start_date' => Carbon::now(),
                    'end_date' => $tiempo->end_date,
                ]);
            }
        }

        session()->forget('score');

        return redirect()->route('exam.result', [
            'course' => $course->id,
            'module' => $module->id,
            'exam' => $exam->id
        ])->with([
            'finalScore' => $finalScore,
            'allQuestions' => $allQuestions,
            'status' => $status,
            'courseId' => $course->id,
        ]);
    } else {
        return redirect()->route('exam.question', [
            'course' => $course->id,
            'module' => $module->id,
            'exam' => $exam->id,
            'index' => $index + 1
        ])->with('status', $isCorrect ? 'Respuesta correcta' : 'Respuesta incorrecta');
    }
}


    public function showResults(Request $request, Course $course, Module $module, Exam $exam)
    {
        $finalScore = $request->session()->get('finalScore');
        $allQuestions = $request->session()->get('allQuestions');
        $status = $request->session()->get('status');
        $courseId = $request->session()->get('courseId');

        return view('exam.resultado', compact('finalScore', 'allQuestions', 'status', 'courseId', 'course', 'module', 'exam'));
    }

}
