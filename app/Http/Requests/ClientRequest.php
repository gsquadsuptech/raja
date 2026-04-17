<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $id = $this->route('client') ? $this->route('client')->id : 0;
        return [
            'prenom' => 'required|max:45',
            'nom' => 'required|max:45',
            'adresse' => 'required|max:255',
            'quartier_id' => 'required',
            'quartier_autre' => 'max:100',
            'genre' => 'required',
            'date_naissance' => 'required|date_format:d/m/Y',
            'email' => 'nullable|email|max:100',
            'telephone1' => 'required|max:20|unique:clients,telephone1,'.$id,
            'telephone2' => 'max:20',
            'poids' => 'nullable|numeric',
            'taille' => 'nullable|numeric',
            'poitrine' => 'nullable|numeric',
            'ceinture' => 'nullable|numeric',
            'poignee' => 'nullable|numeric',
            'bras' => 'nullable|numeric',
            'imc' => 'nullable|numeric',
            'canal_prospect_id' => 'required',
            'canal_prospect_autre' => 'max:100',
            'refere_par' => 'nullable|numeric',
            'notes' => 'nullable',
            'user_edit_avatar_control' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
//            dd($validator);

        });
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
            'date_naissance' => 'date de naissance',
            'telephone1' => 'téléphone',
            'telephone2' => 'téléphone',
            'poignee' => 'poignée',
            'canal_prospect_id' => 'canal de prospection',
            'canal_prospect_autre' => 'canal de prospection',
            'refere_par' => 'référé par',
            'user_edit_avatar_control' => 'photo',
        ];
    }
}
