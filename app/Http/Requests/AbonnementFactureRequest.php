<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbonnementFactureRequest extends FormRequest
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
            'abonnement_id' => 'required',
            'montant_a_payer' => 'required',
            'date_echeance' => 'required|date_format:d/m/Y',
            'date_paiement' => 'date_format:d/m/Y',
            'mode_paiement_code' => 'max:3',
            'statut_facture_code' => 'required|max:3',
            'notes' => 'nullable',
        ];
    }
//
//    public function withValidator($validator)
//    {
//        $validator->after(function ($validator) {
//            dd($validator->errors());
//            if ($this->somethingElseIsInvalid()) {
//                $validator->errors()->add('field', 'Something is wrong with this field!');
//            }
//        });
//    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'abonnement_id' => 'abonnement',
            'montant_a_payer' => 'montant à payer',
            'date_echeance' => 'date d\'échéance',
            'date_paiement' => 'date de paiement',
            'mode_paiement_id' => 'mode de paiement',
            'code_statut_facture' => 'statut de facture',
            'mode_paiement_code' => 'mode de paiement',
        ];
    }
}