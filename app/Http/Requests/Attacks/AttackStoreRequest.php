<?php

namespace App\Http\Requests\Attacks;

use Illuminate\Foundation\Http\FormRequest;

class AttackStoreRequest extends FormRequest
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
           
                'attacker_id'        => 'required|numeric|min:1|exists:players,id',
                'defender_id'        => 'required|numeric|min:1|exists:players,id',
                'attack_type_id'     => 'required|numeric|min:1|exists:attack_types,id',
                'damage'            => 'numeric|min:0'
            
        ];
    }
}
