<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\ModuleProfile;
use App\Models\Course;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
class UsuarioCRUDController extends Controller
{
    public function show(){
        $users = User::all();
        return view('cruds.listaUsuarios', compact('users'));
    }
    public function deleteUser($user_id){
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()->route('usuarios');
    }
    
    public function showCourses($user_id){
        $user = User::findOrFail($user_id);
        $profile = $user->profile;
        $courses = $profile->modules()->with('course')->get()->pluck('course')->unique();
        return view('cruds.listaUsuarioCurso', compact('user', 'courses'));
    }
    public function showModules($user_id, $course_id)
    {
        $user = User::findOrFail($user_id);
        $profile = Profile::where('user_id', $user_id)->firstOrFail();
        $moduleProfiles = ModuleProfile::where('profile_id', $profile->id)->get();
        $completedModules = collect();
        $totalM = 0;

        foreach ($moduleProfiles as $moduleProfile) {
            $modules = $moduleProfile->module()
                                ->where('course_id', $course_id)
                                ->get();
            foreach ($modules as $module) {
                $totalM++;
                if ($moduleProfile->exam_status === 'Aprobado') {
                    $completedModules->push($module);
                }
            }
        }
        $course = Course::findOrFail($course_id);
        $remainingModulesCount = $totalM - $completedModules->count();
        return view('cruds.listaModulosUsuario', compact('user', 'course', 'completedModules', 'remainingModulesCount'));
    }
    public function showProject($user_id, $course_id)
    {
        $user = User::findOrFail($user_id);
        $course = Course::findOrFail($course_id);
        $project = Project::where('course_id', $course->id)
        ->where('profile_id', $user->profile->id)
        ->first();

        return view('cruds.UserProyect', compact('user', 'course', 'project'));
    }
    public function Aprobar($user_id, $course_id){
        $username = User::where('id', $user_id)->value('username');
        $courseName = Course::where('id', $course_id)->value('name');
        $currentDate = Carbon::now()->format('F j, Y');
        $user = User::find($user_id);
        $data = [
            "username" => $username,
            "curso" => $courseName,
            "fecha" => $currentDate,
            "email" => $user->email,
            "title" => "Detalles del curso aprobado",
        ];
        $pdf = PDF::loadView('emails.coursecertification', $data);
        Mail::send('emails.coursecertification', $data, function($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "Certificado.pdf");
        });
        return redirect()->route('usuarios.inscritos', $user_id);
    }
    public function Desaprobar($user_id, $course_id){
        $username = User::where('id', $user_id)->value('username');
        $courseName = Course::where('id', $course_id)->value('name');
        $currentDate = Carbon::now()->format('F j, Y');
        $user = User::find($user_id);
        $data = [
            "username" => $username,
            "curso" => $courseName,
            "fecha" => $currentDate,
            "email" => $user->email,
            "title" => "Detalles del curso desaprobado",
        ];
        Mail::send('emails.coursedesaprobado', $data, function($message) use ($data) {
            $message->to($data["email"], $data["username"])
                    ->subject($data["title"]);
        });
        $proyect = Project::where('course_id', $course_id)
        ->where('profile_id', $user->profile->id)->first();
        $proyect->delete();
        return redirect()->route('usuarios.inscritos', $user_id);
    }
}
