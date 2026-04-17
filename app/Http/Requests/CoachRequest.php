<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoachRequest extends FormRequest
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
        $coach = $this->route('coach');
        return [
            'prenom' => 'required|string|max:145',
            'nom' => 'required|string|max:145',
            'email' => 'required|string|email|max:191|unique:coachs,email,'.($coach->id ?? $coach),
            'type_coach_id' => 'required|exists:type_coachs,id',
            'quartier_id' => 'required|exists:quartiers,id',
            'date_naissance' => 'nullable',
            'notes' => 'nullable',
            'telephone1' => 'required|max:20',
            'telephone2' => 'nullable|max:20',
            'adresse' => 'nullable|max:255',
            'genre' => 'required',
            'photo' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
