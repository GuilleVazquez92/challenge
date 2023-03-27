<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;

class PlayerStoreRequest extends FormRequest
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
                'name'              => 'required|string',
                'email'             => 'required|email',
                'player_type_id'    => 'required|numeric|min:1|exists:player_types,id',
                'life'              => 'numeric|min:1|',
                'attack_points'     => 'numeric|min:0|',
                'defense_points'    => 'numeric|min:0|',
    
        ];
    }
}
