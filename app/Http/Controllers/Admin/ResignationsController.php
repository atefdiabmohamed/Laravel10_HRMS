<?php

namespace App\Http\Controllers\Admin;
use App\Models\Resignation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResignationsController extends Controller
{
   public function index(){
    $com_code=auth()->user()->com_code;
    $data=get_cols_where_p(new Resignation(),array("*"),array("com_code"=>$com_code),"id","DESC",PC );
    return view('admin.Resignations.index',['data'=>$data]);

   }
}
