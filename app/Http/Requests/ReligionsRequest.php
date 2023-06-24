<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReligionsRequest extends FormRequest
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
         'name'=>'required',
         'active'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'اسم الديانة مطلوب',
            'active.required'=>'حالة تفعيل الديانة مطلوب'
           ];  
    }
}
