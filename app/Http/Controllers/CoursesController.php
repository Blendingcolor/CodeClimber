<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function HTML(){
        return view('home.courses.HTML');
    }
    public function CSS(){
        return view('home.courses.CSS');
    }

    public function JS(){
        return view('home.courses.JS');
    }
}