<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin_panel_setting;
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




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin_panel_setting $admin_panel_setting)
    {
        //
    }
}
