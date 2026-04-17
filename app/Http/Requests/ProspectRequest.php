<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProspectRequest extends FormRequest
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
        $prospect = $this->route('prospect');
        $id = $prospect ? $prospect->id : 0;
        $prenom = $prospect ? $prospect->prenom : null;
        $nom = $prospect ? $prospect->nom : null;
        return [
            'prenom' => 'required|max:45',
            'nom' => 'required|max:45',
            'quartier_id' => 'nullable|numeric',
            'quartier_autre' => 'max:100',
            'telephone' => 'required|max:20|unique:prospects,telephone,'.$id.',id,prenom,'.$prenom.',nom,'.$nom,
            'email' => 'nullable|email|max:100',
            'notes' => 'nullable',
            'canal_prospect_id' => 'required',
            'canal_prospect_autre' => 'max:100',
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
            'prenom' => 'prénom',
            'quartier_id' => 'quartier',
            'quartier_autre' => 'quartier',
            'telephone' => 'téléphone',
            'canal_prospect_id' => 'canal de prospection',
            'canal_prospect_autre' => 'canal de prospection',
        ];
    }
}
