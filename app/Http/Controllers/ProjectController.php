<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index($course_id){
        $curso = Course::findOrFail($course_id);
        return view('home.projecto', compact('curso'));
    }

    public function end($course_id){
        $curso = Course::findOrFail($course_id);
        return view('home.cursoFinalizado', compact('curso'));
    }

    public function send(Request $request, $course_id){
        $curso = Course::findOrFail($course_id);
        $profile = auth()->user()->profile;
        
        $project = new Project();
        $project->profile_id = $profile->id;
        $project->course_id = $curso->id;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->Github_Enlace = $request->Github_Enlace;
        $project->save();

        return redirect()->route('projecto.end', ['course_id' => $course_id]);
    }
}
