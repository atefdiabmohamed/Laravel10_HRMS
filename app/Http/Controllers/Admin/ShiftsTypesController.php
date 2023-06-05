<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shifts_type;
use Illuminate\Http\Request;

class ShiftsTypesController extends Controller
{

    public function index()
    {
       
       $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Shifts_type(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PC);
        return view('admin.ShiftsTypes.index', ['data' => $data]);
    }
}
