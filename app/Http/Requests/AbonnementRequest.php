<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbonnementRequest extends FormRequest
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
            'client_id' => 'required',
            'service_id' => 'required',
            'date_debut' => 'required|date_format:d/m/Y',
            'date_fin' => 'required|date_format:d/m/Y',
            'notes' => 'nullable',
            'statut_abo_code' => 'required|max:3',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'client_id' => 'client',
            'service_id' => 'service',
            'date_debut' => 'date de début',
            'date_fin' => 'date de fin',
            'statut_abo_code' => 'statut de l\'abonnement',
        ];
    }
}
