<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'description'   => 'string',
            'power'         => 'numeric',
            'item_id'        => 'numeric|min:0|exists:items,id',
            'player_id'      => 'numeric|min:0|exists:players,id',
            'equipped'        => 'regex:/^[01]$/',
            'name'              => 'string',
            'attack_points'     => 'numeric|min:0',
            'defense_points'    => 'numeric|min:0',
            'item_type_id'      => 'numeric|min:1|exists:item_types,id',
            'email'             => 'email',
            'player_type_id'    => 'numeric|min:0|exists:player_types,id',
            'life'              => 'numeric|min:0',
            'attacker_id'        => 'numeric|min:1|exists:players,id',
            'defender_id'        => 'numeric|min:1|exists:players,id',
            'attack_type_id'     => 'numeric|min:1|exists:attack_types,id',
            'damage'            => 'numeric|min:0',




        ];
    }
}
