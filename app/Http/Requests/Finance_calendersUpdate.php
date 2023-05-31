<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Finance_calendersUpdate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array 
    {
        return [
        'FINANCE_YR'=>'required',
        'FINANCE_YR_DESC'=>'required' ,
        'start_date'=>'required',
        'end_date'=>'required'
        ];
    }
    public function messages(): array
    {
        return [
     'FINANCE_YR.required'=>'كود السنة المالية مطلوب',
     'FINANCE_YR.unique'=>'كود السنة مسجل من قبل ',
     'FINANCE_YR_DESC'=>'وصف السنة المالية مطلوب',
     'start_date'=>'تاريخ بداية السنة المالية مطلوب',
     'end_date'=>'تاريخ نهاية السنة المالية مطلوب'

        ];

    }
}
