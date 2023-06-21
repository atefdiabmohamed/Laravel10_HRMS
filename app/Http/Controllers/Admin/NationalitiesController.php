<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NationalitiesRequest;
use App\Models\Nationalitie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NationalitiesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Nationalitie(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PC);
        return view('admin.Nationalities.index', ['data' => $data]);
    }

    public function create()
    {
        $com_code = auth()->user()->com_code;
        return view('admin.Nationalities.create');
    }

    public function store(NationalitiesRequest $request)
    {
        try {

            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Nationalitie(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToInsert['name'] = $request->name;
            $DataToInsert['active'] = $request->active;
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['com_code'] = $com_code;
            insert(new Nationalitie(), $DataToInsert);
            DB::commit();
            return redirect()->route('Nationalities.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {

        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Nationalitie(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('Nationalities.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        return view('admin.Nationalities.edit', ['data' => $data]);
    }

    public function update($id, NationalitiesRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Nationalitie(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Nationalities.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $CheckExsists = Nationalitie::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Nationalitie(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Nationalities.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }
    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Nationalitie(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Nationalities.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            DB::beginTransaction();
            destroy(new Nationalitie(), array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Nationalities.index')->with(['success' => 'تم الحذف  البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }
}
