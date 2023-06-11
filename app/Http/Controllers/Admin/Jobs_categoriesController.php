<?php

namespace App\Http\Controllers\Admin;

use App\Models\jobs_categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Jobs_categoriesRequest;
use Illuminate\Support\Facades\DB;

class Jobs_categoriesController extends Controller
{
  public function index()
  {
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_p(new jobs_categorie(), array("*"), array('com_code' => $com_code), 'id', 'DESC', PC);
    return view('admin.Jobs_categories.index', ['data' => $data]);
  }

  public function create()
  {
    return view('admin.Jobs_categories.create');
  }

  public function store(Jobs_categoriesRequest $request)
  {
    try {
      $com_code = auth()->user()->com_code;
      $CheckExsists = get_cols_where_row(new jobs_categorie(), array("id"), array("name" => $request->name, 'com_code' => $com_code));
      if (!empty($CheckExsists)) {
        return redirect()->back()->with(['error' => 'عفوا  اسم الوظيفة مسجل من قبل ! '])->withInput();
      }
      DB::beginTransaction();
      $dataToInsert['name'] = $request->name;
      $dataToInsert['active'] = $request->active;
      $dataToInsert['added_by'] = auth()->user()->id;
      $dataToInsert['com_code'] = $com_code;
      insert(new jobs_categorie(), $dataToInsert);
      DB::commit();
      return redirect()->route('jobs_categories.index')->with(['success' => 'تم اضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
      DB::rollBack();
      return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
    }
  }

  public function edit($id)
  {
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_row(new jobs_categorie(), array("*"), array("com_code" => $com_code, 'id' => $id));
    if (empty($data)) {
      return redirect()->route('jobs_categories.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة']);
    }
    return view('admin.Jobs_categories.edit', ['data' => $data]);
  }

  public function update($id, Jobs_categoriesRequest $request)
  {
    $com_code = auth()->user()->com_code;
    try {
      $CheckExsists = jobs_categorie::select("id")->where("com_code", "=", $com_code)->where('name', '=', $request->name)->where('id', '!=', $id)->first();
      if (!empty($CheckExsists)) {
        return redirect()->back()->with(['error' => 'عفوا  اسم الوظيفة مسجل من قبل ! '])->withInput();
      }
      DB::beginTransaction();
      $dataToUpdate['name'] = $request->name;
      $dataToUpdate['active'] = $request->active;
      $dataToUpdate['updated_by'] = auth()->user()->id;
      update(new jobs_categorie(), $dataToUpdate, array("com_code" => $com_code, 'id' => $id));
      DB::commit();
      return redirect()->route('jobs_categories.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
    } catch (\Exception $ex) {
      DB::rollBack();
      return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
    }
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_row(new jobs_categorie(), array("*"), array("com_code" => $com_code, 'id' => $id));
    if (empty($data)) {
      return redirect()->route('jobs_categories.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة']);
    }

  }

  public function destroy($id)
  {
    try{
      $com_code = auth()->user()->com_code;
      $data = get_cols_where_row(new jobs_categorie(), array("*"), array("com_code" => $com_code, 'id' => $id));
      if (empty($data)) {
        return redirect()->route('jobs_categories.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة']);
      }
      DB::beginTransaction();
      destroy(new jobs_categorie(),array("com_code" => $com_code, 'id' => $id));
      DB::commit();
  return redirect()->route('jobs_categories.index')->with(['success'=>'تم الحذف بنجاح']);
    }catch(\Exception $ex){
      DB::rollBack();
      return redirect()->route('jobs_categories.index')->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()]);
    }
 

  }


}
