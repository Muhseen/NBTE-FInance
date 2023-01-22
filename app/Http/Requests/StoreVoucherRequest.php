<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->unit == "Expenditure Control")
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pv_no' => 'required|unique:vouchers,pv_no',
            'payee' => 'required',
            'amount' => 'required|numeric|min:0',
            'txn_date' => 'required|date',
            'bank' => 'required',
            'bank_branch' => 'required',
            'account_no' => 'required',
            'narration' => 'nullable',
            'account_code' => 'required|exists:ncoa,EconSegCode',
            'detailed_description' => 'required',
            'check_by' => 'required',
            'payment_id' => 'nullable',
            'vat' => 'nullable',
            'stamp_duty' => 'nullable',
            'wht' => 'nullable',
        ];
    }
}