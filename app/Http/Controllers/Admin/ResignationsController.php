<?php
namespace App\Http\Controllers\Admin;
use App\Models\Resignation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ResignationsRequest;
use Illuminate\Support\Facades\DB;
class ResignationsController extends Controller
{
public function index()
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_p(new Resignation(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
return view('admin.Resignations.index', ['data' => $data]);
}
public function create()
{
return view('admin.Resignations.create');
}
public function store(ResignationsRequest $request)
{
try {
$com_code = auth()->user()->com_code;
$CheckExsists = get_cols_where_row(new Resignation(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
if (!empty($CheckExsists)) {
return redirect()->back()->with(['error' => 'عفوا الاسم مسجل من قبل '])->withInput();
}
DB::beginTransaction();
$DataToInsert['name'] = $request->name;
$DataToInsert['active'] = $request->active;
$DataToInsert['added_by'] = auth()->user()->id;
$DataToInsert['com_code'] = $com_code;
insert(new Resignation(), $DataToInsert);
DB::commit();
return redirect()->route('Resignations.index')->with(['success' => 'تم ادخل البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
}
}
public function edit($id)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Resignation(), array("*"), array("com_code" => $com_code, "id" => $id));
if (empty($data)) {
return redirect()->route('Resignations.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة !']);
}
return view('admin.Resignations.edit', ['data' => $data]);
} catch (\Exception $ex) {
return redirect()->route('Resignations.index')->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()]);
}
}
public function update($id, ResignationsRequest $request)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Resignation(), array("*"), array("com_code" => $com_code, "id" => $id));
if (empty($data)) {
return redirect()->route('Resignations.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة !']);
}
$CheckExsists = Resignation::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where("id", "!=", $id)->first();
if (!empty($CheckExsists)) {
return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل !'])->withInput();
}
DB::beginTransaction();
$dataToUpdate['name'] = $request->name;
$dataToUpdate['active'] = $request->active;
$dataToUpdate['updated_by'] = auth()->user()->id;
update(new Resignation(), $dataToUpdate, array("com_code" => $com_code, "id" => $id));
DB::commit();
return redirect()->route('Resignations.index')->with(['success' => '  تم تحديث البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->route('Resignations.index')->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()]);
}
}
public function destroy($id)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Resignation(), array("*"), array("com_code" => $com_code, "id" => $id));
if (empty($data)) {
return redirect()->route('Resignations.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة !']);
}
DB::beginTransaction();
destroy(new Resignation(), array("com_code" => $com_code, "id" => $id));
DB::commit();
return redirect()->route('Resignations.index')->with(['success' => '  تم حذف البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->route('Resignations.index')->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()]);
}
}
}