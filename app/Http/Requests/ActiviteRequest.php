<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActiviteRequest extends FormRequest
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
            'nom_activite' => 'required|max:100',
            'type_activite' => 'required|max:100',
            'type_service_id' => 'required',
            'date_debut' => 'nullable',
            'date_fin' => 'nullable',
            'heure_debut' => 'nullable',
            'heure_fin' => 'nullable',
            'jours' => 'nullable|max:100',
        ];
    }
}
