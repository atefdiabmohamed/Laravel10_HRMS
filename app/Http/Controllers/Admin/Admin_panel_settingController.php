<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin_panel_setting;
use App\Http\Requests\Admin_panel_settingRequest;
use Illuminate\Http\Request;

class Admin_panel_settingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = Admin_panel_setting::select('*')->where('com_code', $com_code)->first();
        return view('admin.Admin_panel_setting.index', ['data' => $data]);
    }

    public function edit()
    {
        $com_code = auth()->user()->com_code;
        $data = Admin_panel_setting::select('*')->where('com_code', $com_code)->first();
        return view('admin.Admin_panel_setting.edit', ['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Admin_panel_settingRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $dataToUpdate['company_name'] = $request->company_name;
            $dataToUpdate['phones'] = $request->phones;
            $dataToUpdate['address'] = $request->address;
            $dataToUpdate['email'] = $request->email;
            $dataToUpdate['after_miniute_calculate_delay'] = $request->after_miniute_calculate_delay;
            $dataToUpdate['after_miniute_calculate_early_departure'] = $request->after_miniute_calculate_early_departure;
            $dataToUpdate['after_miniute_quarterday'] = $request->after_miniute_quarterday;
            $dataToUpdate['after_time_half_daycut'] = $request->after_time_half_daycut;
            $dataToUpdate['after_time_allday_daycut'] = $request->after_time_allday_daycut;
            $dataToUpdate['monthly_vacation_balance'] = $request->monthly_vacation_balance;
            $dataToUpdate['after_days_begin_vacation'] = $request->after_days_begin_vacation;
            $dataToUpdate['first_balance_begin_vacation'] = $request->first_balance_begin_vacation;
            $dataToUpdate['sanctions_value_first_abcence'] = $request->sanctions_value_first_abcence;
            $dataToUpdate['sanctions_value_second_abcence'] = $request->sanctions_value_second_abcence;
            $dataToUpdate['sanctions_value_thaird_abcence'] = $request->sanctions_value_thaird_abcence;
            $dataToUpdate['sanctions_value_forth_abcence'] = $request->sanctions_value_forth_abcence;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            Admin_panel_setting::where(['com_code' => $com_code])->update($dataToUpdate);
            return redirect()->route('admin_panel_settings.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما'])->withInput();
        }
    }
}
