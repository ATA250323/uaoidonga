<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtablissementRequest extends FormRequest
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
			'public_id' => 'required',
			'nomarabe' => 'required|string',
			'nomfrancais' => 'required|string',
			'prefixe' => 'required|string',
			'adresse' => 'required|string',
			'email' => 'required|string',
			'telephone' => 'required|string',
			'centre_id' => 'required',
			'anneescolaire_id' => 'required|string',
        ];
    }
}
