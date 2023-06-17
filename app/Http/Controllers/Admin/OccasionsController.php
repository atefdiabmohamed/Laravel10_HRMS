<?php
namespace App\Http\Controllers\Admin;
use App\Models\Occasion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OccasionsRequest;
class OccasionsController extends Controller
{
public function index()
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_p(new Occasion(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PC);
return view('admin.Occasions.index', ['data' => $data]);
}
public function create()
{
return view('admin.Occasions.create');
}
public function store(OccasionsRequest $request)
{
try {
$com_code = auth()->user()->com_code;
$checkExsists = get_cols_where_row(new Occasion(), array("id"), array("com_code" => $com_code, "name" => $request->name));
if (!empty($checkExsists)) {
return redirect()->back()->with(['error' => 'عفوا  هذا الاسم مسجل من قبل '])->withInput();
}
DB::beginTransaction();
$dataToInsert['name'] = $request->name;
$dataToInsert['from_date'] = $request->from_date;
$dataToInsert['to_date'] = $request->to_date;
/*$timeDiffrence=abs((strtotime($dataToInsert['to_date'])-strtotime($dataToInsert['from_date'])));
$dataToInsert['days_counter']=intval($timeDiffrence/86400);
*/
$dataToInsert['days_counter'] = $request->days_counter;
$dataToInsert['active'] = $request->active;
$dataToInsert['added_by'] = auth()->user()->id;
$dataToInsert['com_code'] = $com_code;
insert(new Occasion(), $dataToInsert);
DB::commit();
return redirect()->route('occasions.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
}
}
public function edit($id)
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Occasion(), array("*"), array("com_code" => $com_code, "id" => $id));
if (empty($data)) {
return redirect()->route('occasions.index')->with(['error' => 'عفوا هذه البيانات غير موجوده']);
}
return view('admin.Occasions.edit', ['data' => $data]);
}
public function update($id, OccasionsRequest $request)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Occasion(), array("*"), array("com_code" => $com_code, "id" => $id));
if (empty($data)) {
return redirect()->route('occasions.index')->with(['error' => 'عفوا هذه البيانات غير موجوده']);
}
$checkExsists = Occasion::select('id')->where('com_code', '=', $com_code)->where('name', '=', $request->name)->where('id', '!=', $id)->first();
if (!empty($checkExsists)) {
return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
}
DB::beginTransaction();
$dataToUpdate['name'] = $request->name;
$dataToUpdate['from_date'] = $request->from_date;
$dataToUpdate['to_date'] = $request->to_date;
$dataToUpdate['days_counter'] = $request->days_counter;
$dataToUpdate['active'] = $request->active;
$dataToUpdate['updated_by'] = auth()->user()->id;
update(new Occasion(), $dataToUpdate, array("com_code" => $com_code, "id" => $id));
DB::commit();
return redirect()->route('occasions.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
}
}
public function destroy($id)
{
try {
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Occasion(), array("*"), array("com_code" => $com_code, "id" => $id));
if (empty($data)) {
return redirect()->route('occasions.index')->with(['error' => 'عفوا هذه البيانات غير موجوده']);
}
DB::beginTransaction();
destroy(new Occasion(), array("com_code" => $com_code, "id" => $id));
DB::commit();
return redirect()->route('occasions.index')->with(['success' => 'تم حذف البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->route('occasions.index')->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()]);
}
}
}