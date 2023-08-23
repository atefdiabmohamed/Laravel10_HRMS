<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branche;
use App\Models\Departement;
use App\Models\jobs_categorie;
use App\Models\Qualification;

class EmployeesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.Employees.index", ['data' => $data]);
    }
    public function create(){
        $com_code = auth()->user()->com_code;
        $other['branches']=get_cols_where(new Branche(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
        $other['departements']=get_cols_where(new Departement(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
        $other['jobs']=get_cols_where(new jobs_categorie(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
        $other['qualifications']=get_cols_where(new Qualification(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
        return view("admin.Employees.create",['other'=>$other]);  
    }
}
