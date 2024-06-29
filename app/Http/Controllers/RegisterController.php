<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClasificatorioUsuario;
use Illuminate\Auth\Events\Registered;
use App\Models\Course;
use App\Models\ModuleProfile;



class RegisterController extends Controller
{
    public function show(){
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        $user = User::create($request->validated());

        // Crear el perfil del usuario
        $profile = Profile::create([
            'user_id' => $user->id,
        ]);

        // Crear el ClasificatorioUsuario
        ClasificatorioUsuario::create([
            'user_id' => $user->id,
            'puntaje' => 0, // Puntaje inicial cero
        ]);

        // Disparar el evento Registered
        event(new Registered($user));

        // Autenticar al usuario
        Auth::login($user);

        // Redirigir a la página de inicio
        return redirect('/home');
    }
}
