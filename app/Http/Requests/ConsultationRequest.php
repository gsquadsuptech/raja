<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
            'patient_id' => 'nullable',
            'medecin_id' => 'nullable',
            'date_consultation' => 'nullable',
            'code_statut' => 'nullable|max:3',
            'date_attente' => 'nullable',
            'notes' => 'nullable'
        ];
    }
}
