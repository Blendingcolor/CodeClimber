<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payments;
use App\Models\Payments_details;
use App\Models\Course;
use App\Models\ModuleProfile;
use App\Models\Profile;
use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class PDFCursoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;
        $payment_id = $request->input('payment_id');

        $payment = Payments::find($payment_id);
        $payment_details = Payments_details::where('payment_id', $payment_id)->first();

        if (!$payment || !$payment_details) {
            return redirect()->route('catalogo')->with('error', 'Detalles de pago no encontrados.');
        }

        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $course_id = $payment_details->curso_id;
        $course = Course::find($course_id);

        // Log de verificación
        Log::info('Course Data', ['course_id' => $course_id, 'course' => $course]);

        if (!$course) {
            Log::error('Course not found', ['course_id' => $course_id]);
            return redirect()->route('cancel');
        }

        $module = Module::where('course_id', $course_id)->first();

        // Log de verificación
        Log::info('Module Data', ['module' => $module]);

        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($course->period);

        // Log de verificación
        Log::info('Dates', ['start_date' => $startDate, 'end_date' => $endDate]);

        ModuleProfile::create([
            'module_id' => $module->id,
            'profile_id' => $profile->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $data = [
            "email" => $email, // Reemplaza con el correo de destino
            "title" => "Detalle de la compra",
            "body" => "Detalles de la compra realizada.",
            "payment" => $payment,
            "payment_details" => $payment_details,
        ];

        // Generar el PDF
        $pdf = PDF::loadView('emails.myTestMail', $data);

        // Enviar el correo
        Mail::send('emails.myTestMail', $data, function($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "detalles_compra.pdf");
        });

        return redirect()->route('home.index')->with('success', 'Correo enviado con los detalles de la compra.');
    }
}
