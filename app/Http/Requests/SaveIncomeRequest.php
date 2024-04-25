<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveIncomeRequest extends FormRequest
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
            'source'       => 'required|max:100',
            'amount'       => 'required|numeric|between:0,999999.99',
            'description'  => 'required',
            'income_date'  => 'required|date',
        ];
    }
}
