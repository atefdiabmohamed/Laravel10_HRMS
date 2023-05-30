<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\Monthes;
use Illuminate\Http\Request;
use App\Http\Requests\Finance_calenders_Request;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
class Finance_calendersController extends Controller
{
/**
* Display a listing of the resource.
*/
public function index()
{
$data = Finance_calender::select("*")->orderby('FINANCE_YR', 'DESC')->paginate(PAGEINATION_COUNTER);
return view('admin.Finance_calender.index', ['data' => $data]);
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
try {
DB::beginTransaction();
$dataToInsert['FINANCE_YR'] = $request->FINANCE_YR;
$dataToInsert['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
$dataToInsert['start_date'] = $request->start_date;
$dataToInsert['end_date'] = $request->end_date;
$dataToInsert['added_by'] = auth()->user()->id;
$dataToInsert['com_code'] = auth()->user()->com_code;
$falg = Finance_calender::insert($dataToInsert);
if ($falg) {
$dataParent = Finance_calender::select("id")->where($dataToInsert)->first();
$startDate = new DateTime($request->start_date);
$endDate = new DateTime($request->end_date);
$dareInterval = new DateInterval('P1M');
$datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
foreach ($datePerioud as $date) {
$dataMonth['finance_calenders_id'] = $dataParent['id'];
$Montname_en = $date->format('F');
$dataParentMonth = Monthes::select("id")->where(['name_en' => $Montname_en])->first();
$dataMonth['MONTH_ID'] = $dataParentMonth['id'];
$dataMonth['FINANCE_YR'] = $dataToInsert['FINANCE_YR'];
$dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
$dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
$dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
$datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
$dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
$dataMonth['com_code'] = auth()->user()->com_code;
$dataMonth['updated_at'] = date("Y-m-d H:i:s");
$dataMonth['created_at'] = date("Y-m-d H:i:s");
$dataMonth['added_by'] = auth()->user()->id;
$dataMonth['updated_by'] = auth()->user()->id;
$dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
$dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
Finance_cln_periods::insert($dataMonth);
}
}
DB::commit();
return redirect()->route('finance_calender.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
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
public function destroy($id)
{
try {
$data = Finance_calender::select("*")->where(['id' => $id])->first();
if (empty($data)) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
}
if ($data['is_open'] == 1) {
return redirect()->back()->with(['error' => ' عفوا لايمكن حذف سنة مالية مفتوحة']);
}
$flag = Finance_calender::where(['id' => $id])->delete();
if ($flag) {
//this is optional in case there is no relationship
Finance_cln_periods::where(['finance_calenders_id' => $id])->delete();
}
return redirect()->route('finance_calender.index')->with(['success' => 'تم حذف البيانات بنجاح']);
} catch (\Exception $ex) {
return redirect()->back()->with(['error' => ' عفوا حدث خطأ '] . $ex->getMessage());
}
}
function show_year_monthes(Request $request){
if($request->ajax()){
$finance_cln_periods=Finance_cln_periods::select("*")->where(['finance_calenders_id'=>$request->id])->get();
return view("admin.Finance_calender.show_year_monthes",['finance_cln_periods'=>$finance_cln_periods]);
}
}
}