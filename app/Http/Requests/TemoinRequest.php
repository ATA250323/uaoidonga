<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemoinRequest extends FormRequest
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
			'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048', // max 2MB
			'messagear' => 'string',
			'messagefr' => 'string',
			'nom_prenom' => 'string',
			'nom_organe' => 'string',
        ];
    }
}
