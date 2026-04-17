<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModePaiementRequest extends FormRequest
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
        $id = $this->route('mode_paiement');
        return [
            'mode_paiement' => 'required|max:100|unique:mode_paiements,mode_paiement,'. $id,
            'mode_paiement_code' => 'required|max:3|unique:mode_paiements,mode_paiement_code,'. $id,
            'is_default' => 'nullable|numeric',
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
            'mode_paiement' => 'mode de paiement',
            'mode_paiement_code' => 'code du mode de paiement',
        ];
    }
}
