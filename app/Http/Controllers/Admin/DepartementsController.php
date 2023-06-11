<?php

namespace App\Http\Controllers\Admin;

use App\Models\Departement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DepartementsRequest;
use Illuminate\Support\Facades\DB;

class DepartementsController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Departement(), array("*"), array('com_code' => $com_code), 'id', 'DESC', PC);
        return view('admin.Departements.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.Departements.create');
    }

    public function store(DepartementsRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Departement(), array('id'), array("com_code" => $com_code, 'name' => $request->name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا اسم الادارة مسجل من قبل !'])->withInput();
            }
            DB::beginTransaction();
            $dataToinsert['name'] = $request->name;
            $dataToinsert['phones'] = $request->phones;
            $dataToinsert['notes'] = $request->notes;
            $dataToinsert['active'] = $request->active;
            $dataToinsert['added_by'] = auth()->user()->id;
            $dataToinsert['com_code'] = $com_code;
            insert(new Departement(), $dataToinsert);
            DB::commit();
            return  redirect()->route('departements.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Departement(), array("*"), array('com_code' => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('departements.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
        }
        return view('admin.Departements.edit', ['data' => $data]);
    }
    public function update($id, DepartementsRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Departement(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('departements.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            $CheckExsists = Departement::select("id")->where('com_code', '=', $com_code)->where('name', '=', $request->name)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا اسم الادارة مسجل من قبل !'])->withInput();
            }
            DB::beginTransaction();
            $dataToUpdate['name'] = $request->name;
            $dataToUpdate['phones'] = $request->phones;
            $dataToUpdate['notes'] = $request->notes;
            $dataToUpdate['active'] = $request->active;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            update(new Departement(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('departements.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Departement(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('departements.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Departement(), array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('departements.index')->with(['success' => 'تم حذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
}
