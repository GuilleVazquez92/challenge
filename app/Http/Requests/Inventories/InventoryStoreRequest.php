<?php

namespace App\Http\Requests\Inventories;

use Illuminate\Foundation\Http\FormRequest;

class InventoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
           
                'item_id'        => 'required|integer',
                'player_id'      => 'required|integer',
                'equipped'        => 'regex:/^[01]$/'
        ];
    }

    public function messages(): array
    {
        return [
            'item_id.required'      => 'The :attribute is required',
            'item_id.integer'       => 'A  :attribute must be integer',
            'player_id.required'    => 'The :attribute is required',
            'player_id.integer'     => 'A  :attribute must be integer',
            'equipped.regex'        => 'A :attribute must be 0 or 1'

        ];
    }
}
