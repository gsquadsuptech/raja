<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParametreRequest extends FormRequest
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
            'nom_salle' => 'required|max:50',
            'slogan' => 'nullable|max:255',
            'date_creation' => 'nullable',
            'email_contact' => 'nullable|email|max:100',
            'adresse' => 'required|max:255',
            'telephone1' => 'required|numeric|digits_between:7,20',
            'telephone2' => 'nullable|numeric|digits_between:7,20',
            'site_web' => 'nullable|max:50',
            'delai_rappel' => 'required|numeric',
            'logo' => 'nullable|max:200',
            'favicon' => 'nullable|max:200',
            'couleur_header' => 'required|max:10',
            'couleur_header_icons' => 'required|max:10',
            'couleur_sidebar' => 'required|max:10',
            'couleur_texte_sidebar' => 'required|max:10',
            'couleur_texte_sidebar_selectionne' => 'required|max:10',
        ];
    }
}
