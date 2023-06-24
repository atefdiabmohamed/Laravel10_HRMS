<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeesController extends Controller
{
    public function index(){
    $com_code=auth()->user()->com_code;
    $data=get_cols_where_p(new Employee(),array("*"),array("com_code"=>$com_code),"id","DESC",PC);
    return view("admin.Employees.index",['data'=>$data]);
    }
}
