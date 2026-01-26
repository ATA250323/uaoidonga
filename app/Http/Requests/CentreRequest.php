<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentreRequest extends FormRequest
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
			'nomar' => 'string',
			'nomfr' => 'nullable',
			// 'prefixe' => 'required|string',
			'adresse' => 'nullable',
			'email' => 'nullable',
			'telephone' => 'nullable',
			'anneescolaire_id' => 'required',
        ];
    }
}
