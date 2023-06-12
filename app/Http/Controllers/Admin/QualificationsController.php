<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\QualificationsRequest;
class QualificationsController extends Controller
{
public function index()
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_p(new Qualification(), array("*"), array('com_code' => $com_code), 'id', 'DESC', PC);
return view('admin.Qualifications.index', ['data' => $data]);
}
public function create()
{
return view('admin.Qualifications.create');
}
public function store(QualificationsRequest $request)
{
try {
$com_code = auth()->user()->com_code;
$checkExsists = get_cols_where_row(new Qualification(), array("id"), array("name" => $request->name, "com_code" => $com_code));
if (!empty($checkExsists)) {
return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل !!'])->withInput();
}
DB::beginTransaction();
$DataToInsert['name'] = $request->name;
$DataToInsert['active'] = $request->active;
$DataToInsert['added_by'] = auth()->user()->com_code;
$DataToInsert['com_code'] = $com_code;
insert(new Qualification(), $DataToInsert);
DB::commit();
return redirect()->route('Qualifications.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
}
}
public function edit($id)
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Qualification(), array("*"), array("com_code" => $com_code, 'id' => $id));
if (empty($data)) {
return redirect()->route('Qualifications.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
}
return view('admin.Qualifications.edit', ['data' => $data]);
}
public function update($id, QualificationsRequest $request)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Qualification(), array("*"), array("com_code" => $com_code, 'id' => $id));
if (empty($data)) {
return redirect()->route('Qualifications.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
}
$checkExsists = Qualification::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where("id", "!=", $id)->first();
if (!empty($checkExsists)) {
return redirect()->back()->with(['error' => 'عفوا هذه الاسم مسجل من قبل '])->withInput();
}
DB::beginTransaction();
$dataToUpdate['name'] = $request->name;
$dataToUpdate['active'] = $request->active;
$dataToUpdate['updated_by'] = auth()->user()->id;
update(new Qualification(), $dataToUpdate, array("com_code" => $com_code, 'id' => $id));
DB::commit();
return redirect()->route('Qualifications.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
}
}
public function destroy($id)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Qualification(), array("*"), array("com_code" => $com_code, 'id' => $id));
if (empty($data)) {
return redirect()->route('Qualifications.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
}
DB::beginTransaction();
destroy(new Qualification(), array("com_code" => $com_code, 'id' => $id));
DB::commit();
return redirect()->route('Qualifications.index')->with(['success' => 'تم حذف البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()]);
}
}
}