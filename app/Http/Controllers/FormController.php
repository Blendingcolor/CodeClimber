<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //
    public function register(){
        return "Bienvenido al registro";
    }
    public function login(){
        return "En esta pagina se uso el login";
    }


    public function logout(){
        return "Bienvenido a la salida";
    }
}
