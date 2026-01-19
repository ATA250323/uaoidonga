<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirigentRequest extends FormRequest
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
			'nom' => 'string',
			'profession' => 'string',
			'facebook' => 'string',
			'whatsapp' => 'string',
			'tiweter' => 'string',
			'email' => 'string',
			'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048', // max 2MB
        ];
    }
}
