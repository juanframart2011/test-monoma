<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Puedes agregar lógica de autorización aquí si es necesario,
        // como permitir solo a usuarios managers crear leads.
        return auth()->user()->isManager();
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'owner' => 'required|exists:users,id',  // Verifica que el owner exista en la tabla users
        ];
    }

    /**
     * Define los mensajes de error personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'source.required' => 'El campo fuente es obligatorio.',
            'owner.required' => 'El campo propietario es obligatorio.',
            'owner.exists' => 'El propietario debe ser un usuario válido.',
        ];
    }
}