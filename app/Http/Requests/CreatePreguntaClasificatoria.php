<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePreguntaClasificatoria extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'texto' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'respuestas' => 'required|array|min:4|max:4',
            'respuestas.*.texto' => 'required|string|max:255',
            'correcta' => 'required|integer|min:0|max:3',
        ];
    }
    public function messages()
    {
        return [
            'texto.required' => 'El campo texto es obligatorio.',
            'grupo.required' => 'El campo grupo es obligatorio.',
            'respuestas.required' => 'Se requieren 4 respuestas.',
            'respuestas.*.texto.required' => 'Cada respuesta necesita un texto.',
            'correcta.required' => 'Debe indicar cuál es la respuesta correcta.',
        ];
    }
}