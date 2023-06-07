<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shifts_type;
use Illuminate\Http\Request;
use App\Http\Requests\ShiftTypesRequest;
use Illuminate\Support\Facades\DB;

class ShiftsTypesController extends Controller
{

    public function index()
    {

        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Shifts_type(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PC);
        return view('admin.ShiftsTypes.index', ['data' => $data]);
    }
    public function create()
    {
        return view('admin.ShiftsTypes.create');
    }

    public function store(ShiftTypesRequest $request)
    {
        try {
            $dataToInsert['com_code'] = auth()->user()->com_code;
            $dataToInsert['type'] = $request->type;
            $dataToInsert['from_time'] = $request->from_time;
            $dataToInsert['to_time'] = $request->to_time;
            $dataToInsert['total_hour'] = $request->total_hour;
            $checkExsitsData = get_cols_where_row(new Shifts_type(), array("id"), $dataToInsert);
            if (!empty($checkExsitsData)) {
                return redirect()->back()->with(['error' => 'عفوا هذه البيانات مسجلة من قبل !'])->withInput();
            }
            $dataToInsert['active'] = $request->active;
            $dataToInsert['added_by'] = auth()->user()->id;
            DB::beginTransaction();
            insert(new Shifts_type(), $dataToInsert);
            DB::commit();
            return redirect()->route('ShiftsTypes.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Shifts_type(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('ShiftsTypes.index')->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
        }
        return view('admin.ShiftsTypes.edit', ['data' => $data]);
    }

    public function update($id, ShiftTypesRequest $request)
    {


        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Shifts_type(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('ShiftsTypes.index')->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
            }

            $checkExsitsData = Shifts_type::select("id")->where('type', '=', $request->type)->where('from_time', '=', $request->from_time)->where('to_time', '=', $request->to_time)->where('total_hour', '=', $request->total_hour)->where('id', '!=', $id)->first();
            if (!empty($checkExsitsData)) {
                return redirect()->back()->with(['error' => 'عفوا هذه البيانات مسجلة من قبل !'])->withInput();
            }
            DB::beginTransaction();
            $dataToUpdate['type'] = $request->type;
            $dataToUpdate['from_time'] = $request->from_time;
            $dataToUpdate['to_time'] = $request->to_time;
            $dataToUpdate['total_hour'] = $request->total_hour;
            $dataToUpdate['active'] = $request->active;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            update(new Shifts_type(), $dataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('ShiftsTypes.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {

        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Shifts_type(), array("id"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('ShiftsTypes.index')->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
            }
            DB::beginTransaction();
            destroy(new Shifts_type(), array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('ShiftsTypes.index')->with(['success' => 'تم حذف البيانات بنجاح']);
          
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
}
