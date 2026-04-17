<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'prenom' => 'required|max:100',
            'nom' => 'required|max:100',
            'sexe' => 'required',
            'adresse' => 'nullable|max:255',
            'telephone' => 'nullable|max:20',
            'email' => 'nullable',
            'date_naissance' => 'nullable',
        ];
    }
}
