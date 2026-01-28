<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			// 'public_id' => 'required',
			'nom' => 'required|string',
			'prenom' => 'required|string',
			'sexe' => 'required|string',
			'numero_table' => 'string',
			// 'centre_id' => 'required',
			'etablissement_id' => 'required',
			'anneescolaire_id' => 'required',
			'categorie_examen_id' => 'required',
        ];
    }
}
