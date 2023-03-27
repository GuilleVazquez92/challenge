<?php

namespace App\Http\Requests\Attacks;

use Illuminate\Foundation\Http\FormRequest;

class AttackTypeStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'power' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'A  :attribute is required',
            'power required' => 'The :attribute is required',
            'power.required' => 'The :attribute must be numeric',
        ];
    }
}
