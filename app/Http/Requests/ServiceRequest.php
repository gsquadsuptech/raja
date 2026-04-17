<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'type_service_id' => 'required|exists:type_services,id',
            'type_service_autre' => 'string|max:100',
            'cout' => 'required',
            'duree' => 'required',
        ];
    }
}
