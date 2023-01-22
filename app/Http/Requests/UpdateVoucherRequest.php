<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   UpdateVoucherRequest extends FormRequest
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
            'pv_no' => 'required',
            'payee' => 'required',
            'amount' => 'required|numeric|min:0',
            'txn_date' => 'required|date',
            'bank' => 'required',
            'bank_branch' => 'required',
            'account_no' => 'required',
            'narration' => 'nullable',
            'account_code' => 'required|exists:ncoa,EconSegCode',
            'detailed_description' => 'required',
            'vat' => 'nullable',
            'stamp_duty' => 'nullable',
            'wht' => 'nullable',
        ];
    }
}