@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Employees.index') }}">     الموظفين</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة  موظف جديد
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Employees.store') }}" method="post" enctype="multipart/form-data">
            @csrf
      
   <!-- /.card -->
   <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title text-right" style="width: 100%;
        text-align: right !important;">
          <i class="fas fa-edit"></i>
          البيانات المطلوبة للموظف
        </h3>
      </div>
      <div class="card-body">
      
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="personal_date" data-toggle="pill" href="#custom-content-personal_data" role="tab" aria-controls="custom-content-personal_data" aria-selected="true">بيانات شخصية</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="jobs_data" data-toggle="pill" href="#custom-content-jobs_data" role="tab" aria-controls="custom-content-jobs_data" aria-selected="false">بيانات وظيفة</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="addtional_data" data-toggle="pill" href="#custom-content-addtional_data" role="tab" aria-controls="custom-content-addtional_data" aria-selected="false">بيانات اضافية</a>
          </li>
          
        </ul>
        <div class="tab-content" id="custom-content-below-tabContent">
          <div class="tab-pane fade show active" id="custom-content-personal_data" role="tabpanel" aria-labelledby="personal_date">
          <br>
            <div class="row">
         
               <div class="col-md-4">
                  <div class="form-group">
                     <label>    كود بصمة الموظف</label>
                     <input autofocus type="text" name="zketo_code" id="zketo_code" class="form-control" value="{{ old('zketo_code') }}" >
                     @error('zketo_code')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>    اسم الموظف  كاملا</label>
                     <input type="text" name="emp_name" id="emp_name" class="form-control" value="{{ old('emp_name') }}" >
                     @error('emp_name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>  نوع الجنس</label>
                     <select  name="emp_gender" id="emp_gender" class="form-control">
                     <option   @if(old('emp_gender')==1) selected @endif  value="1">ذكر</option>
                     <option @if(old('emp_gender')==2 ) selected @endif value="1">انثي</option>
                     </select>
                     @error('emp_gender')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>   الفرع التابع له الموظف</label>
                     <select name="branch_id " id="branch_id " class="form-control select2 ">
                        <option value="">اختر الفرع</option>
                        @if (@isset($other['branches']) && !@empty($other['branches']))
                        @foreach ($other['branches'] as $info )
                        <option @if(old('branches')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('branch_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>


   

               <div class="col-md-4">
                  <div class="form-group">
                     <label>  المؤهل الدراسي</label>
                     <select name="Qualifications_id" id="Qualifications_id  " class="form-control select2 ">
                        <option value="">اختر المؤهل</option>
                        @if (@isset($other['qualifications']) && !@empty($other['qualifications']))
                        @foreach ($other['qualifications'] as $info )
                        <option @if(old('Qualifications_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('Qualifications_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>       سنة التخرج</label>
                     <input type="text" name="Qualifications_year" id="Qualifications_year" class="form-control" value="{{ old('Qualifications_year') }}" >
                     @error('Qualifications_year')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>   تقدير التخرج</label>
                     <select  name="graduation_estimate" id="graduation_estimate" class="form-control">
                     <option   @if(old('graduation_estimate')==1) selected @endif  value="1">مقبول</option>
                     <option @if(old('graduation_estimate')==2 ) selected @endif value="2">جيد</option>
                     <option @if(old('graduation_estimate')==3 ) selected @endif value="3">جيد مرتفع</option>
                     <option @if(old('graduation_estimate')==4 ) selected @endif value="4">جيد جداً</option>
                     <option @if(old('graduation_estimate')==5 ) selected @endif value="5">إمتياز </option>
                
                  </select>
                     @error('graduation_estimate')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>       تخصص التخرج</label>
                     <input type="text" name="Graduation_specialization" id="Graduation_specialization" class="form-control" value="{{ old('Graduation_specialization') }}" >
                     @error('Graduation_specialization')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>


               
               <div class="col-md-4">
                  <div class="form-group">
                     <label>        تاريخ الميلاد</label>
                     <input type="date" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date') }}" >
                     @error('brith_date')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>         رقم بطاقة الهوية</label>
                     <input type="text" name="emp_national_idenity" id="emp_national_idenity" class="form-control" value="{{ old('emp_national_idenity') }}" >
                     @error('emp_national_idenity')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>         مركز اصدار بطاقة الهوية </label>
                     <input type="text" name="emp_identityPlace" id="emp_identityPlace" class="form-control" value="{{ old('emp_identityPlace') }}" >
                     @error('emp_identityPlace')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>         تاريخ انتهاء بطاقة الهوية</label>
                     <input type="date" name="emp_end_identityIDate" id="emp_end_identityIDate" class="form-control" value="{{ old('emp_end_identityIDate') }}" >
                     @error('emp_end_identityIDate')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>   فصيلة الدم</label>
                     <select name="blood_group_id" id="blood_group_id" class="form-control select2 ">
                        <option value="">اختر الفصيلة</option>
                        @if (@isset($other['blood_groups']) && !@empty($other['blood_groups']))
                        @foreach ($other['blood_groups'] as $info )
                        <option @if(old('blood_group_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('blood_group_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>    الجنسية</label>
                     <select name="emp_nationality_id" id="emp_nationality_id" class="form-control select2 ">
                        <option value="">اختر الجنسية</option>
                        @if (@isset($other['nationalities']) && !@empty($other['nationalities']))
                        @foreach ($other['nationalities'] as $info )
                        <option @if(old('emp_nationality_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('emp_nationality_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>  اللغة الاساسية التي يتحدث بها</label>
                     <select name="emp_lang_id  " id="emp_lang_id  " class="form-control select2 ">
                        <option value="">اختر الوظيفة</option>
                        @if (@isset($other['languages']) && !@empty($other['languages']))
                        @foreach ($other['languages'] as $info )
                        <option @if(old('emp_lang_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('emp_lang_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>    الديانة</label>
                     <select name="religion_id" id="religion_id" class="form-control select2 ">
                        <option value="">اختر الديانة</option>
                        @if (@isset($other['religions']) && !@empty($other['religions']))
                        @foreach ($other['religions'] as $info )
                        <option @if(old('religion_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('religion_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>      البريد الالكتروني</label>
                     <input type="text" name="emp_email" id="emp_email" class="form-control" value="{{ old('emp_email') }}" >
                     @error('emp_email')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>    الدول</label>
                     <select name="country_id" id="country_id" class="form-control select2 ">
                        <option value="">اختر الدولة التابع لها الموظف</option>
                        @if (@isset($other['countires']) && !@empty($other['countires']))
                        @foreach ($other['countires'] as $info )
                        <option @if(old('countires')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('country_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group" id="governorates_Div">
                     <label>    المحافظات</label>
                     <select name="governorates_id" id="governorates_id" class="form-control select2 ">
                        <option value="">اختر المحافظة التابع لها الموظف</option>
                      
                     </select>
                     @error('governorates_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group" id="centers_div">
                     <label>    المدينة/المركز</label>
                     <select name="city_id" id="city_id" class="form-control select2 ">
                        <option value="">اختر المدينة التابع لها الموظف</option>
                      
                     </select>
                     @error('city_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>       عنوان الاقامة الحالي للموظف</label>
                     <input type="text" name="staies_address" id="staies_address" class="form-control" value="{{ old('staies_address') }}" >
                     @error('staies_address')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>     هاتف المنزل</label>
                     <input type="text" name="emp_home_tel" id="emp_home_tel" class="form-control" value="{{ old('emp_home_tel') }}" >
                     @error('emp_home_tel')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>     هاتف العمل</label>
                     <input type="text" name="emp_work_tel" id="emp_work_tel" class="form-control" value="{{ old('emp_work_tel') }}" >
                     @error('emp_work_tel')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>    حالة الخدمة العسكرية</label>
                     <select name="emp_military_id" id="emp_military_id" class="form-control select2 ">
                        <option value="">اختر  الحالة </option>
                        @if (@isset($other['military_status']) && !@empty($other['military_status']))
                        @foreach ($other['military_status'] as $info )
                        <option @if(old('emp_military_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('country_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class="col-md-4 related_miltary_1"  style="display: none;">
                  <div class="form-group">
                     <label>    تاريخ بداية الخدمة العسكرية	</label>
                     <input type="date" name="emp_military_date_from" id="emp_military_date_from" class="form-control" value="{{ old('emp_military_date_from') }}" >
                     @error('emp_military_date_from')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>


               <div class="col-md-4 related_miltary_1"  style="display: none;">
                  <div class="form-group">
                     <label>    تاريخ نهاية الخدمة العسكرية	</label>
                     <input type="date" name="emp_military_date_to" id="emp_military_date_to" class="form-control" value="{{ old('emp_military_date_to') }}" >
                     @error('emp_military_date_to')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4 related_miltary_1"  style="display: none;">
                  <div class="form-group">
                     <label>     سلاح الخدمة العسكرية	</label>
                     <input type="text" name="emp_military_wepon	" id="emp_military_wepon	" class="form-control" value="{{ old('emp_military_wepon') }}" >
                     @error('emp_military_wepon	')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4 related_miltary_2"  style="display: none;">
                  <div class="form-group">
                     <label>    تاريخ اعفاء الخدمة العسكرية	</label>
                     <input type="date" name="exemption_date" id="exemption_date" class="form-control" value="{{ old('exemption_date') }}" >
                     @error('exemption_date')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>


               <div class="col-md-4 related_miltary_2"  style="display: none;">
                  <div class="form-group">
                     <label>    سبب اعفاء الخدمة العسكرية	</label>
                     <input type="text" name="exemption_reason" id="exemption_reason" class="form-control" value="{{ old('exemption_reason') }}" >
                     @error('exemption_reason')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4 related_miltary_3"  style="display: none;">
                  <div class="form-group">
                     <label>  سبب ومدة تأجيل الخدمة العسكرية</label>
                     <input type="text" name="postponement_reason" id="postponement_reason" class="form-control" value="{{ old('postponement_reason') }}" >
                     @error('postponement_reason')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>


               <div class="col-md-4">
                  <div class="form-group">
                     <label>    هل يمتلك رخصة قيادة</label>
                     <select  name="does_has_Driving_License" id="does_has_Driving_License" class="form-control">
                        <option value="">  اختر الحالة</option>
                     <option   @if(old('graduation_estimate')==1) selected @endif  value="1">نعم </option>
                     <option @if(old('graduation_estimate')==0 and old('graduation_estimate')!="" ) selected @endif value="2">لا</option>
                
                  </select>
                     @error('does_has_Driving_License')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4 related_does_has_Driving_License"  style="display: none;">
                  <div class="form-group">
                     <label>  رقم رخصة القيادة</label>
                     <input type="text" name="driving_License_degree" id="driving_License_degree" class="form-control" value="{{ old('driving_License_degree') }}" >
                     @error('driving_License_degree')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-4 related_does_has_Driving_License"  style="display: none;">
                  <div class="form-group">
                     <label>  نوع رخصة القيادة</label>
                     <select name="driving_license_types_id" id="driving_license_types_id" class="form-control select2 ">
                        <option value="">اختر  الحالة </option>
                        @if (@isset($other['driving_license_types']) && !@empty($other['driving_license_types']))
                        @foreach ($other['driving_license_types'] as $info )
                        <option @if(old('driving_license_types_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('driving_license_types_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>    هل يمتلك  أقارب بالعمل </label>
                     <select  name="has_Relatives" id="has_Relatives" class="form-control">
                        <option value="">  اختر الحالة</option>
                     <option   @if(old('has_Relatives')==1) selected @endif  value="1">نعم </option>
                     <option @if(old('has_Relatives')==0 and old('has_Relatives')!="" ) selected @endif value="2">لا</option>
                
                  </select>
                     @error('has_Relatives')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-8 Related_Relatives_detailsDiv"  style="display: none;">
                  <div class="form-group">
                     <label> تفاصيل الاقارب</label>
                     <textarea type="text" name="Relatives_details" id="Relatives_details" class="form-control" >
                        {{ old('Relatives_details') }}

                     </textarea>
                     @error('Relatives_details')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>    هل يمتلك اعاقة / عمليات سابقة </label>
                     <select  name="is_Disabilities_processes" id="is_Disabilities_processes" class="form-control">
                        <option value="">  اختر الحالة</option>
                     <option   @if(old('is_Disabilities_processes')==1) selected @endif  value="1">نعم </option>
                     <option @if(old('is_Disabilities_processes')==0 and old('is_Disabilities_processes')!="" ) selected @endif value="2">لا</option>
                
                  </select>
                     @error('is_Disabilities_processes')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

               <div class="col-md-8 Related_is_Disabilities_processesDiv"  style="display: none;">
                  <div class="form-group">
                     <label> تفاصيل الاعاقة / عمليات سابقة</label>
                     <textarea type="text" name="Disabilities_processes" id="Disabilities_processes" class="form-control" >
                        {{ old('Disabilities_processes') }}

                     </textarea>
                     @error('Disabilities_processes')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               <div class="col-md-12 " >
                  <div class="form-group">
                     <label> ملاحظات علي الموظف </label>
                     <textarea type="text" name="notes" id="notes" class="form-control" >
                        {{ old('notes') }}

                     </textarea>
                     @error('notes')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>

           </div>

         </div>
          <div class="tab-pane fade" id="custom-content-jobs_data" role="tabpanel" aria-labelledby="jobs_data">
            <br>
            <div class="row">
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>   تاريخ التعيين</label>
                  <input type="date" name="emp_start_date" id="emp_start_date" class="form-control" value="{{ old('emp_start_date') }}" >
                  @error('emp_start_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label>    الحالة الوظيفية</label>
                  <select  name="Functiona_status" id="Functiona_status" class="form-control">
                  <option   @if(old('Functiona_status')==1) selected @endif  value="1">يعمل</option>
                  <option @if(old('Functiona_status')==0 and old('Functiona_status')!="" ) selected @endif value="0">خارج الخدمة</option>
             
               </select>
                  @error('Functiona_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>   الادارة التابع لها الموظف</label>
                  <select name="emp_Departments_code " id="emp_Departments_code " class="form-control select2 ">
                     <option value="">اختر الادارة</option>
                     @if (@isset($other['departements']) && !@empty($other['departements']))
                     @foreach ($other['departements'] as $info )
                     <option @if(old('departements_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('departements_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label> وظيفة الموظف</label>
                  <select name="emp_jobs_id  " id="emp_jobs_id  " class="form-control select2 ">
                     <option value="">اختر الوظيفة</option>
                     @if (@isset($other['jobs']) && !@empty($other['jobs']))
                     @foreach ($other['jobs'] as $info )
                     <option @if(old('jobs')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('emp_jobs_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له بصمة حضور وانصراف</label>
                  <select  name="does_has_ateendance" id="does_has_ateendance" class="form-control">
                  <option   @if(old('does_has_ateendance')==1) selected @endif  value="1">نعم</option>
                  <option @if(old('does_has_ateendance')==0 and old('does_has_ateendance')!="" ) selected @endif value="0"> لا </option>
             
               </select>
                  @error('does_has_ateendance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له شفت ثابت</label>
                  <select  name="is_has_fixced_shift" id="is_has_fixced_shift" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('is_has_fixced_shift')==1) selected @endif  value="1">نعم</option>
                  <option @if(old('is_has_fixced_shift')==0 and old('is_has_fixced_shift')!="" ) selected @endif value="0"> لا </option>
             
               </select>
                  @error('is_has_fixced_shift')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4 relatedfixced_shift"  @if(old('do_has_shift')!=1) style="display: none;" @endif>
               <div class="form-group">
                  <label>       أنواع الشفتات</label>
                  <select name="shifts_types_id" id="shifts_types_id" class="form-control select2 ">
                     <option value="">اختر الشفت</option>
                     @if (@isset($other['shifts_types']) && !@empty($other['shifts_types']))
                     @foreach ($other['shifts_types'] as $info )
                     <option @if(old('shifts_types_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> 
                        
                        @if($info->type==1) صباحي @elseif ($info->type==2) مسائي @else يوم كامل @endif
                        من
                        @php
                        $dt=new DateTime($info->from_time);
                        $time=$dt->format("h:i");
                        $newDateTime=date("A",strtotime($info->from_time));
                        $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                        @endphp
                       
                        {{ $time }}
                        {{ $newDateTimeType }}  
                        الي
                        @php
                        $dt=new DateTime($info->to_time);
                        $time=$dt->format("h:i");
                        $newDateTime=date("A",strtotime($info->to_time));
                        $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                        @endphp
                       
                        {{ $time }}
                        {{ $newDateTimeType }}  
                     عدد
                     {{ $info->total_hour*1  }} ساعات
                     
                     
                     
                     
                     </option>
                     @endforeach
                     @endif
                  </select>
                  @error('shifts_types_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            <div class="col-md-4" id="daily_work_hourDiv" style="display: none;">
               <div class="form-group">
                  <label>       عدد ساعات العمل اليومي</label>
                  <input type="text" name="daily_work_hour" id="daily_work_hour" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('daily_work_hour') }}" >
                  @error('daily_work_hour')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4" >
               <div class="form-group">
                  <label>     راتب الموظف الشهري</label>
                  <input type="text" name="emp_sal" id="emp_sal" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('emp_sal') }}" >
                  @error('emp_sal')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له حافز </label>
                  <select  name="MotivationType" id="MotivationType" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('MotivationType')==1) selected @endif  value="1">ثابت</option>
                  <option   @if(old('MotivationType')==2) selected @endif  value="2">متغير</option>
                  <option @if(old('MotivationType')==0 and old('MotivationType')!="" ) selected @endif value="0"> لايوجد </option>
             
               </select>
                  @error('MotivationType')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4 " id="MotivationDIV" style="display: none" >
               <div class="form-group">
                  <label> قيمة الحافز الشهري الثابت</label>
                  <input type="text" name="Motivation" id="Motivation" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('Motivation') }}" >
                  @error('Motivation')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له تأمين اجتماعي </label>
                  <select  name="isSocialnsurance" id="isSocialnsurance" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('isSocialnsurance')==1) selected @endif  value="1">نعم</option>
                  <option @if(old('isSocialnsurance')==0 and old('isSocialnsurance')!="" ) selected @endif value="0"> لا </option>
             
               </select>
                  @error('isSocialnsurance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4 relatedisSocialnsurance" " style="display: none" >
               <div class="form-group">
                  <label> قيمة التأمين المستقطع شهرياً</label>
                  <input type="text" name="Socialnsurancecutmonthely" id="Socialnsurancecutmonthely" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('Socialnsurancecutmonthely') }}" >
                  @error('Socialnsurancecutmonthely')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4 relatedisSocialnsurance" " style="display: none" >
               <div class="form-group">
                  <label> رقم التامين الاجتماعي للموظف</label>
                  <input type="text" name="SocialnsuranceNumber" id="SocialnsuranceNumber" class="form-control" value="{{ old('SocialnsuranceNumber') }}" >
                  @error('SocialnsuranceNumber')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له تأمين طبي </label>
                  <select  name="ismedicalinsurance" id="ismedicalinsurance" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('ismedicalinsurance')==1) selected @endif  value="1">نعم</option>
                  <option @if(old('ismedicalinsurance')==0 and old('ismedicalinsurance')!="" ) selected @endif value="0"> لا </option>
             
               </select>
                  @error('ismedicalinsurance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4 relatedismedicalinsurance" " style="display: none" >
               <div class="form-group">
                  <label> قيمة التأمين الطبي المستقطع شهرياً</label>
                  <input type="text" name="medicalinsurancecutmonthely" id="medicalinsurancecutmonthely" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('medicalinsurancecutmonthely') }}" >
                  @error('medicalinsurancecutmonthely')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4 relatedismedicalinsurance" " style="display: none" >
               <div class="form-group">
                  <label> رقم التامين الطبي للموظف</label>
                  <input type="text" name="medicalinsuranceNumber" id="medicalinsuranceNumber" class="form-control" value="{{ old('medicalinsuranceNumber') }}" >
                  @error('medicalinsuranceNumber')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label> نوع صرف راتب الموظف</label>
                  <select  name="sal_cach_or_visa" id="sal_cach_or_visa" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('sal_cach_or_visa')==1) selected @endif  value="1">كاش</option>
                  <option   @if(old('sal_cach_or_visa')==2) selected @endif  value="2">فيزا</option>
             
               </select>
                  @error('sal_cach_or_visa')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label> هل له رصيد اجازات سنوي</label>
                  <select  name="is_active_for_Vaccation" id="is_active_for_Vaccation" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('is_active_for_Vaccation')==1) selected @endif  value="1">نعم</option>
                  <option   @if(old('is_active_for_Vaccation')==0 and old('is_active_for_Vaccation')!=""  ) selected @endif  value="0">لا</option>
             
               </select>
                  @error('is_active_for_Vaccation')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4 " >
               <div class="form-group">
                  <label>  شخص يمكن الرجوع اليه للضرورة  	</label>
                  <input type="text" name="urgent_person_details" id="urgent_person_details" class="form-control" value="{{ old('urgent_person_details') }}" >
                  @error('urgent_person_details')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

         </div>
         </div>
          <div class="tab-pane fade" id="custom-content-addtional_data" role="tabpanel" aria-labelledby="addtional_data">
            <br>
            <div class="row">
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>  اسم الكفيل 	</label>
                  <input type="text" name="emp_cafel" id="emp_cafel" class="form-control" value="{{ old('emp_cafel') }}" >
                  @error('emp_cafel')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>   رقم الباسبور ان وجد 	</label>
                  <input type="text" name="emp_pasport_no" id="emp_pasport_no" class="form-control" value="{{ old('emp_pasport_no') }}" >
                  @error('emp_pasport_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-4 " >
               <div class="form-group">
                  <label>جهة اصدار الباسبور	</label>
                  <input type="text" name="emp_pasport_from" id="emp_pasport_from" class="form-control" value="{{ old('emp_pasport_from') }}" >
                  @error('emp_pasport_from')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>  تاريخ انتهاء الباسبور	</label>
                  <input type="text" name="emp_pasport_exp" id="emp_pasport_exp" class="form-control" value="{{ old('emp_pasport_exp') }}" >
                  @error('emp_pasport_exp')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-8">
               <div class="form-group">
                  <label>    عنوان اقامة الموظف في بلده الام	</label>
                  <input type="text" name="emp_Basic_stay_com" id="emp_Basic_stay_com" class="form-control" value="{{ old('emp_Basic_stay_com') }}" >
                  @error('emp_Basic_stay_com')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>   الصورة الشخصية للموظف</label>
                  <input type="file" name="emp_photo" id="emp_photo" class="form-control" value="{{ old('emp_photo') }}" >
                  @error('emp_photo')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>     السرة الذاتية للموظف</label>
                  <input type="file" name="emp_CV" id="emp_CV" class="form-control" value="{{ old('emp_CV') }}" >
                  @error('emp_CV')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
         </div>

         </div>
     
        </div>
       
      </div>
      <!-- /.card -->
    </div>
    <!-- /.card -->


            
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الموظف </button>
                  <a href="{{ route('Religions.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   
   
   </div>
</div>
@endsection
@section("script")
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   $(document).on('change','#country_id',function(e){
      get_governorates();
      });
   function get_governorates(){
   var country_id=$("#country_id").val();
   jQuery.ajax({
   url:'{{ route('Employees.get_governorates') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',country_id:country_id},
   success: function(data){
   $("#governorates_Div").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}

$(document).on('change','#governorates_id',function(e){
      get_centers();
      });
   function get_centers(){
   var governorates_id=$("#governorates_id").val();
   jQuery.ajax({
   url:'{{ route('Employees.get_centers') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',governorates_id:governorates_id},
   success: function(data){
   $("#centers_div").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}

$(document).on('change','#emp_military_id',function(e){
      var emp_military_id=$(this).val();
      if(emp_military_id==1){
         $(".related_miltary_1").show();
         $(".related_miltary_2").hide();
         $(".related_miltary_3").hide();
      }else if(emp_military_id==2){
         $(".related_miltary_1").hide();
         $(".related_miltary_2").show();
         $(".related_miltary_3").hide(); 
      }
      else if(emp_military_id==3){
         $(".related_miltary_1").hide();
         $(".related_miltary_2").hide();
         $(".related_miltary_3").show();   
      }else{
         $(".related_miltary_1").hide();
         $(".related_miltary_2").hide();
         $(".related_miltary_3").hide();

      }
      });

      $(document).on('change','#does_has_Driving_License',function(e){
 if($(this).val()==1  ){
$(".related_does_has_Driving_License").show();
 }else{
   $(".related_does_has_Driving_License").hide();
 }
   });
   $(document).on('change','#has_Relatives',function(e){
 if($(this).val()==1  ){
$(".Related_Relatives_detailsDiv").show();
 }else{
   $(".Related_Relatives_detailsDiv").hide();
 }
   });

   $(document).on('change','#is_Disabilities_processes',function(e){
 if($(this).val()==1  ){
$(".Related_is_Disabilities_processesDiv").show();
 }else{
   $(".Related_is_Disabilities_processesDiv").hide();
 }
   });

   $(document).on('change','#is_has_fixced_shift',function(e){
 if($(this).val()==1  ){
$(".relatedfixced_shift").show();
$("#daily_work_hourDiv").hide();
 }else{
   $(".relatedfixced_shift").hide();
   $("#daily_work_hourDiv").show();

 }
   });
   
   $(document).on('change','#MotivationType',function(e){
 if($(this).val()!=1 ){
$("#MotivationDIV").hide();
 }else{
   $("#MotivationDIV").show();

 }
 
   });

   $(document).on('change','#isSocialnsurance',function(e){
 if($(this).val()!=1 ){
$(".relatedisSocialnsurance").hide();
 }else{
   $(".relatedisSocialnsurance").show();

 }

   });
   

   $(document).on('change','#ismedicalinsurance',function(e){
 if($(this).val()!=1 ){
$(".relatedismedicalinsurance").hide();
 }else{
   $(".relatedismedicalinsurance").show();

 }

   });
</script>
@endsection