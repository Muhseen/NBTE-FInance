<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBudgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'projection' => 'required|numeric|min:0',
            'actual' => 'required|numeric|min:0',
            'approved' => 'required|numeric|min:0',
            'released' => 'required|numeric|min:0'
        ];
    }
}