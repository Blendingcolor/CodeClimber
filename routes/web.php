<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\CoursesController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\CrudCalificatoriosController;
use App\Http\Controllers\CursoCRUDController;
use App\Http\Controllers\CatalogoController;
use Illuminate\Http\Request;
use App\Http\Controllers\ModuloCRUDController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PDFCursoController;
use App\Models\Course;
use App\Http\Middleware\CheckCourseEnrollmentMiddleware;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\MaterialCRUDController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UsuarioCRUDController;

Route::get('/', [HomeController::class, 'showC'])->name('index');
Route::get('/Catalogo', [CatalogoController::class, 'index'])->name('catalogo')->middleware(['auth', 'verified']);
Route::post('/Catalogo/{course_id}/inscription', [CatalogoController::class, 'inscription'])->name('course.inscription');

Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware(['auth', 'verified']);
Route::get('/home/course/{courseId}', [HomeController::class, 'show'])->name('course.show')->middleware(['auth', 'verified']);
Route::get('/home/course/{course}/module/{module}', [HomeController::class, 'showM'])->name('module.show')->middleware(['auth', 'verified']);
Route::get('/home/course/{course}/module/{module}/exam/{exam}/question/{index}', [HomeController::class, 'showQuestion'])->name('exam.question')->middleware(['auth', 'verified']);
Route::post('/home/course/{course}/module/{module}/exam/{exam}/question/{index}', [HomeController::class, 'submitQuestion'])->name('exam.submit')->middleware(['auth', 'verified']);

///proyecto/////////////
Route::get('/home/course/{course_id}/projecto', [ProjectController::class, 'index'])->name('projecto.view')->middleware(['auth', 'verified']);
Route::post('/home/course/{course_id}/projecto/enviado', [ProjectController::class, 'send'])->name('projecto.send')->middleware(['auth', 'verified']);
Route::get('/home/course/{course_id}/project/finalizado', [ProjectController::class, 'end'])->name('projecto.end')->middleware(['auth', 'verified']);
///

Route::get('/home/course/{course}/module/{module}/exam/{exam}/result', [HomeController::class, 'showResults'])->name('exam.result')->middleware(['auth', 'verified']);
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::get('/preguntas', [PreguntaController::class, 'mostrarPreguntas'])->name('preguntas.mostrar')->middleware(['auth', 'verified']);
Route::post('/guardar-respuestas', [PreguntaController::class, 'guardarRespuesta'])->name('preguntas.guardar')->middleware(['auth', 'verified']);
Route::get('/terminadoclasificatorio', [PreguntaController::class, 'salidamostrar'])->name('examen.completado')->middleware(['auth', 'verified']);

////////////////Crud Usuarios
Route::get('/controlusuarios', [UsuarioCRUDController::class, 'show'])->name('usuarios')->middleware(['auth', 'verified']);
Route::get('/controlusuarios/{user_id}/cursos', [UsuarioCRUDController::class, 'showCourses'])->name('usuarios.inscritos')->middleware(['auth', 'verified']);
Route::get('/controlusuarios/{user_id}/cursos/{course_id}/proyecto', [UsuarioCRUDController::class, 'showProject'])->name('usuario.proyecto')->middleware(['auth', 'verified']);
Route::post('/controlusuarios/{user_id}/cursos/{course_id}/proyecto/aprobo', [UsuarioCRUDController::class, 'Aprobar'])->name('usuario.aprobo')->middleware(['auth', 'verified']);
Route::post('/controlusuarios/{user_id}/cursos/{course_id}/proyecto/desaprobo', [UsuarioCRUDController::class, 'Desaprobar'])->name('usuario.desaprobo')->middleware(['auth', 'verified']);
Route::get('/controlusuarios/{user_id}/cursos/{course_id}/modulos', [UsuarioCRUDController::class, 'showModules'])->name('usuarios.cursos.modulos')->middleware(['auth', 'verified']);
Route::delete('/controlusuarios/{user_id}/destroy', [UsuarioCRUDController::class, 'deleteUser'])->name('usuarios.destroy')->middleware(['auth', 'verified']);
Route::get('/usuarios/{user_id}/cursos/{course_id}/proyecto', [UsuarioCRUDController::class, 'showProject'])->name('usuarios.cursos.proyecto')->middleware(['auth', 'verified']);
////////////////

Route::get('/controlclasificatorio', [CrudCalificatoriosController::class, 'listado'])->name('crudsclasificatorio.listado')->middleware(['auth', 'verified']);
Route::post('/controlclasificatorio-registrar', [CrudCalificatoriosController::class, 'create'])->name('crudsclasificatorio.create')->middleware(['auth', 'verified']);
Route::get('/controlclasificatorio-modificar/{id}/editar', [CrudCalificatoriosController::class, 'editar'])->name('crudsclasificatorio.editar')->middleware(['auth', 'verified']);
Route::post('/controlclasificatorio-modificar/{id}/update', [CrudCalificatoriosController::class, 'update'])->name('crudsclasificatorio.update')->middleware(['auth', 'verified']);
Route::post('/controlclasificatorio-eliminar/{id}/eliminar', [CrudCalificatoriosController::class, 'destroy'])->name('crudsclasificatorio.eliminar')->middleware(['auth', 'verified']);
Route::get('/controlcursos', [CursoCRUDController::class, 'listado'])->name('crudscursos.listado')->middleware(['auth', 'verified']);
Route::post('/controlcursos-registrar', [CursoCRUDController::class, 'create'])->name('crudscursos.create')->middleware(['auth', 'verified']);
Route::get('/controlcursos-modificar/{id}/editar', [CursoCRUDController::class, 'editar'])->name('crudscursos.editar')->middleware(['auth', 'verified']);
Route::get('/controlcursos-mostrar/{id}/mostrar', [CursoCRUDController::class, 'mostrar'])->name('crudscursos.mostrar')->middleware(['auth', 'verified']);
Route::post('/controlcursos-modificar/{id}/update', [CursoCRUDController::class, 'update'])->name('crudscursos.update')->middleware(['auth', 'verified']);
Route::post('/controlcursos-eliminar/{id}/eliminar', [CursoCRUDController::class, 'destroy'])->name('crudscursos.eliminar')->middleware(['auth', 'verified']);
Route::post('/controlcursos/{curso_id}/modulos', [ModuloCRUDController::class, 'store'])->name('crudscursos.modulos.store')->middleware(['auth', 'verified']);
Route::post('/controlcursos/{curso_id}/modulos/{id}/update', [ModuloCRUDController::class, 'update'])->name('crudscursos.modulos.update')->middleware(['auth', 'verified']);
Route::post('/controlcursos/{curso_id}/modulos/{id}/destroy', [ModuloCRUDController::class, 'destroy'])->name('crudscursos.modulos.destroy')->middleware(['auth', 'verified']);
Route::get('/controlcursos/{curso_id}/modulos/{id}/editar', [ModuloCRUDController::class, 'editar'])->name('crudscursos.modulos.editar')->middleware(['auth', 'verified']);
Route::get('/controlcursos/{curso_id}/modulos/{id}/mostrar', [ModuloCRUDController::class, 'mostrar'])->name('crudscursos.modulos.mostrar')->middleware(['auth', 'verified']);
Route::post('/contenido/{id}/editar', [ModuloCRUDController::class, 'editarcontenido'])->name('contenido.editar')->middleware(['auth', 'verified']);
//////////////////////////////////////nuevos cruds
Route::get('/controlcursos/{curso_id}/modulos/{id}/mostrar', [MaterialCRUDController::class, 'ShowSections'])->name('crudscursos.section')->middleware(['auth', 'verified']);
Route::post('/controlcursos/{curso_id}/modulos/{id}/create', [MaterialCRUDController::class, 'create'])->name('crudscursos.section.create')->middleware(['auth', 'verified']);
Route::delete('/controlcursos/{curso_id}/modulos/{id}/section/{section_id}/destroy', [MaterialCRUDController::class, 'destroy'])->name('crudcursos.section.destroy')->middleware(['auth', 'verified']);
Route::get('/controlcursos/{curso_id}/modulos/{id}/section/{section_id}/editar', [MaterialCRUDController::class, 'editar'])->name('crudscursos.section.edit')->middleware(['auth', 'verified']);
Route::post('/controlcursos/{curso_id}/modulos/{id}/section/{section_id}/update', [MaterialCRUDController::class, 'update'])->name('crudscursos.section.update')->middleware(['auth', 'verified']);
Route::get('/controlcursos/{curso_id}/modulos/{id}/section/{section_id}/content/{content_id}/editar', [MaterialCRUDController::class, 'editContents'])->name('editarContenido')->middleware(['auth', 'verified']);
Route::post('/controlcursos/{curso_id}/modulos/{id}/section/{section_id}/content/{content_id}', [MaterialCRUDController::class, 'updateContents'])->name('actualizarContenido')->middleware(['auth', 'verified']);
/////////////////////////////////////
Route::get('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/mostrar', [ModuloCRUDController::class, 'listadopreguntasexamen'])
    ->name('crudscursos.examen.mostrar')
    ->middleware(['auth', 'verified']);

Route::post('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/create', [ModuloCRUDController::class, 'CrearPregunta'])
    ->name('crudscursos.examen.crear')
    ->middleware(['auth', 'verified']);

Route::delete('controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/destroy', [ModuloCRUDController::class, 'EliminarPregunta'])
    ->name('crudscursos.examen.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/update', [ModuloCRUDController::class, 'ActualizarPregunta'])
    ->name('crudscursos.examen.update')
    ->middleware(['auth', 'verified']);

Route::get('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/editar', [ModuloCRUDController::class, 'EditarPregunta'])
    ->name('crudscursos.examen.editar')
    ->middleware(['auth', 'verified']);

Route::get('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/mostrar', [ModuloCRUDController::class, 'MostrarAlternativas'])
    ->name('crudscursos.alternativas.mostrar')
    ->middleware(['auth', 'verified']);

Route::post('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/create', [ModuloCRUDController::class, 'CrearAlternativa'])
    ->name('crudscursos.alternativas.crear')
    ->middleware(['auth', 'verified']);

Route::delete('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/alternativa/{alternative_id}/destroy', [ModuloCRUDController::class, 'EliminarAlternativa'])
    ->name('crudscursos.alternativa.destroy')
    ->middleware(['auth', 'verified']);

Route::get('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/alternativa/{alternative_id}/editar', [ModuloCRUDController::class, 'EditarAlternativa'])
    ->name('crudscursos.alternativa.editar')
    ->middleware(['auth', 'verified']);

Route::post('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/alternativa/{alternative_id}/update', [ModuloCRUDController::class, 'ActualizarAlternativa'])
    ->name('crudscursos.alternativa.update')
    ->middleware(['auth', 'verified']);

Route::get('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/alternative/{alternative_id}/respuesta/{answer_id}/editar', [ModuloCRUDController::class, 'EditarRespuesta'])
    ->name('crudscursos.respuesta.editar')
    ->middleware(['auth', 'verified']);


Route::put('/controlcursos/{curso_id}/modulos/{id}/examen/{exam_id}/pregunta/{question_id}/alternative/{alternative_id}/respuesta/{respuesta_id}', [ModuloCRUDController::class, 'actualizarRespuesta'])
    ->name('crudscursos.respuesta.actualizar')
    ->middleware(['auth', 'verified']);



// Ruta para la notificación de verificación de correo electrónico
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Ruta para manejar la verificación de correo electrónico
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/preguntas');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Ruta para reenviar el correo de verificación
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/comprarcurso/{curso}', function ($cursoId) {

    $curso = Course::find($cursoId);

    return view('paypal.pago', ['curso' => $curso]);

})->name('comprarcurso')->middleware(['auth', 'verified' ,'CheckCourseEnrollment']);


Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');

Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');


Route::get('send-email-pdf-console', [PDFCursoController::class, 'index'])->name('send-email-pdf-console');

Route::get('/alertas',[ComentarioController::class, 'mostrar'])->name('mostraralertas');

Route::post('/comentarios', [ComentarioController::class, 'guardar'])->name('guardar.problema');

Route::get('/home/course/{courseId}/exam/initial', [HomeController::class, 'initialExam'])->name('exam.initial')->middleware(['auth', 'verified']);

Route::post('/respuesta/guardar/{preguntaId}', [HomeController::class, 'guardarRespuesta'])->name('respuesta.guardar')->middleware(['auth', 'verified']);

Route::get('/terminadoclasificatorio/{moduloClasificado}', [PreguntaController::class, 'salidamostrar'])->name('examen.completado')->middleware(['auth', 'verified']);