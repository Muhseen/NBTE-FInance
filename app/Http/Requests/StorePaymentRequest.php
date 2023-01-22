<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'txn_date' => 'required',
            'amount' => 'required',
            'voucher_id' => 'nullable',
            'narration' => 'nullable',
            'file_no' => 'nullable',
            'funding_account' => 'required',
            'account_code' => 'required',
            'batch_no' => 'nullable',
            'payee' => 'nullable'
        ];
    }
}