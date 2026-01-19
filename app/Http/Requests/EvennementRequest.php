<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvennementRequest extends FormRequest
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
			'titrear' => 'string',
			// 'titrefr' => 'string',
			'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048', // max 2MB
			'organisation_id' => 'required',
			'anneescolaire_id' => 'required|string',
        ];
    }
}
