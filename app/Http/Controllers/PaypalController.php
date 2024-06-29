<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payments;
use App\Models\Payments_details;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Course;
use App\Models\ModuleProfile;
use App\Models\Profile;
use App\Models\Module;

class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        // Validar los parámetros de entrada
        $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'curso_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);

        // Verificar la respuesta de PayPal y redirigir al usuario
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    // Almacenar los datos en la sesión
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', $request->quantity);
                    session()->put('curso_id', $request->curso_id);
                    session()->put('price', $request->price);
                    session()->put('currency', 'USD'); // Suponiendo que la moneda es PEN

                    // Redirigir al enlace de aprobación de PayPal
                    return redirect()->away($link['href']);
                }
            }
        } else {
            Log::error('Error al crear la orden de PayPal', ['response' => $response]);
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $payment = new Payments;
            $payment->user_id = auth()->id(); // Asegurarse de que el usuario está autenticado
            $payment->purchase_date = Carbon::now();
            $payment->payment_method = "PayPal";
            $payment->payment_id = $response['id'];
            $payment->save();

            // Crear el registro en la tabla Payments_details
            $detallesPayment = new Payments_details;
            $detallesPayment->payment_id = $payment->id;
            $detallesPayment->curso_id = session()->get('curso_id'); // Obtener curso_id de la sesión
            $detallesPayment->quantity = session()->get('quantity');
            $detallesPayment->amount = session()->get('price');
            $detallesPayment->currency = session()->get('currency');
            $detallesPayment->product_name = session()->get('product_name');
            $detallesPayment->payer_name = $response['payer']['name']['given_name'];
            $detallesPayment->payer_email = $response['payer']['email_address'];
            $detallesPayment->payment_status = $response['status'];
            $detallesPayment->save();

            // Limpiar las variables de sesión
            session()->forget('product_name');
            session()->forget('quantity');
            session()->forget('curso_id');
            session()->forget('price');
            session()->forget('currency');

            return redirect()->route('send-email-pdf-console', ['payment_id' => $payment->id]);
        } else {
            Log::error('Error al capturar el pago de PayPal', ['response' => $response]);
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        return "El pago ha sido cancelado.";
    }
}
