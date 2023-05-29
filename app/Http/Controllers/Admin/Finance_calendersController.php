<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finance_calender;
use Illuminate\Http\Request;
use App\Http\Requests\Finance_calenders_Request;
use Illuminate\Support\Facades\DB;
class Finance_calendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $data=Finance_calender::select("*")->orderby('FINANCE_YR','DESC')->paginate(PAGEINATION_COUNTER);
    return view('admin.Finance_calender.index',['date'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    return view('admin.Finance_calender.create');    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Finance_calenders_Request $request)
    {
      try{
     DB::beginTransaction();
       $dataToInsert['FINANCE_YR']=$request->FINANCE_YR;
       $dataToInsert['FINANCE_YR_DESC']=$request->FINANCE_YR_DESC;
       $dataToInsert['start_date']=$request->start_date;
       $dataToInsert['end_date']=$request->end_date;
       $dataToInsert['added_by']=auth()->user()->id;
       $falg=Finance_calender::insert($dataToInsert);
      DB::commit();
      return redirect()->route('finance_calender.index')->with(['success'=>'تم ادخال البيانات بنجاح']);
      }catch(\Exception $ex){
      DB::rollBack();
        return redirect()->back()->with(['error'=>'عفوا حدث خطا '.$ex->getMessage()])->withInput();
      } 


    }

    /**
     * Display the specified resource.
     */
    public function show(Finance_calender $finance_calender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance_calender $finance_calender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finance_calender $finance_calender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance_calender $finance_calender)
    {
        //
    }
}
