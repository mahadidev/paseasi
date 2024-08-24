<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNeedHelpRequest extends FormRequest
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
            "name" => ["nullable", "string"],
            "details" => ["required", "string"],
            'location' => ["nullable", "string"],
            "phone" => ["required", "string",],
            "phone_optional" => ["nullable", "string"],
            "picture" => ["nullable"],
        ];
    }
}
