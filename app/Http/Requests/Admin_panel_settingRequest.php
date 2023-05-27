<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Admin_panel_settingRequest extends FormRequest
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
           'company_name'=>'required',
           'phones'=>'required',
           'address'=>'required',
           'after_miniute_calculate_delay'=>'required',
           'after_miniute_calculate_early_departure'=>'required',
           'after_miniute_quarterday'=>'required',
           'after_time_half_daycut'=>'required',
           'after_time_allday_daycut'=>'required',
           'monthly_vacation_balance'=>'required',
           'after_days_begin_vacation'=>'required',
           'first_balance_begin_vacation'=>'required',
           'sanctions_value_first_abcence'=>'required',
           'sanctions_value_second_abcence'=>'required',
           'sanctions_value_thaird_abcence'=>'required',
           'sanctions_value_forth_abcence'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
       'company_name.required'=>'اسم الشركة مطلوب',
       'phones.required'=>'هاتف الشركة مطلوب',
       'address.required'=>'عنوان الشركة مطلوب',
       'after_miniute_calculate_delay'=>'بعد كم دقيقة نحسب تاخير حضور مطلوب',
       'after_miniute_calculate_early_departure'=>'بعد كم دقيقة نحسب انصراف مبكر مطلوب',
       'after_miniute_quarterday'=>'بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم مطلوب',
       'after_time_half_daycut'=>'بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم مطلوب',
       'after_time_allday_daycut'=>'نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل مطلوب ',
       'monthly_vacation_balance'=>'رصيد اجازات الموظف الشهري مطلوب',
       'after_days_begin_vacation'=>'بعد كم يوم ينزل للموظف رصيد اجازات مطلوب',
       'first_balance_begin_vacation'=>' الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف مطلوب',
       'sanctions_value_first_abcence'=>' الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف مطلوب',
       'sanctions_value_second_abcence'=>'قيمة خصم الايام بعد ثاني مرة غياب بدون اذن مطلوب',
       'sanctions_value_thaird_abcence'=>'قيمة خصم الايام بعد ثالث مرة غياب بدون اذن مطلوب',
       'sanctions_value_forth_abcence'=>'قيمة خصم الايام بعد رابع مرة غياب بدون اذن مطلوب',

        ];
    }
}
