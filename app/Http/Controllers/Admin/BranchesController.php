<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Branche;
use Illuminate\Http\Request;
use App\Http\Requests\BrachesRequest;
use Illuminate\Support\Facades\DB;
class BranchesController extends Controller
{
public function index()
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_p(new Branche(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
return view('admin.Branches.index', ['data' => $data]);
}
public function create()
{
return view('admin.Branches.create');
}
public function store(BrachesRequest $requst)
{
try {
$com_code = auth()->user()->com_code;
$checkExsists = get_cols_where_row(new Branche(), array("id"), array("com_code" => $com_code, 'name' => $requst->name));
if (!empty($checkExsists)) {
return redirect()->back()->with(['error' => 'عفوا اسم الفرع مسجل من قبل !'])->withInput();
}
DB::beginTransaction();
$dataToInsert['name'] = $requst->name;
$dataToInsert['address'] = $requst->address;
$dataToInsert['phones'] = $requst->phones;
$dataToInsert['email'] = $requst->email;
$dataToInsert['active'] = $requst->active;
$dataToInsert['added_by'] = auth()->user()->id;
$dataToInsert['com_code'] = $com_code;
insert(new Branche(), $dataToInsert);
DB::commit();
return redirect()->route('branches.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
} catch (\Exception $ex) {
DB::rollBack();
return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
}
}
public function edit($id)
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Branche(), array("*"), array("id" => $id, 'com_code' => $com_code));
if (empty($data)) {
return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
}
return view('admin.Branches.edit', ['data' => $data]);
}
public function update($id,BrachesRequest $requst)
{
try{
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Branche(), array("*"), array("id" => $id, 'com_code' => $com_code));
if (empty($data)) {
return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
}
DB::beginTransaction();
$dataToUpdate['name'] = $requst->name;
$dataToUpdate['address'] = $requst->address;
$dataToUpdate['phones'] = $requst->phones;
$dataToUpdate['email'] = $requst->email;
$dataToUpdate['active'] = $requst->active;
$dataToUpdate['updated_by'] = auth()->user()->id;
update(new Branche(),$dataToUpdate,array("id" => $id, 'com_code' => $com_code));
DB::commit();
return redirect()->route('branches.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
}catch(\Exception $ex){
DB::rollBack();
return redirect()->back()->with(['error'=>'عفوا حدث خطا  '.$ex->getMessage()])->withInput();
}
} 
public function destroy($id){
try{
$com_code = auth()->user()->com_code;
$data = get_cols_where_row(new Branche(), array("*"), array("id" => $id, 'com_code' => $com_code));
if (empty($data)) {
return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
}
DB::beginTransaction();
destroy(new Branche(),array("id" => $id, 'com_code' => $com_code));
DB::commit();
return redirect()->route('branches.index')->with(['success' => 'تم حذف البيانات بنجاح']);
}catch(\Exception $ex){
DB::rollBack();
return redirect()->route('branches.index')->with(['error'=>'عفوا حدث خطا  '.$ex->getMessage()]);
}
}   
}