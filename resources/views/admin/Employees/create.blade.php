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
         <form action="{{ route('Employees.store') }}" method="post">
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

           </div>

         </div>
          <div class="tab-pane fade" id="custom-content-jobs_data" role="tabpanel" aria-labelledby="jobs_data">
             Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
          </div>
          <div class="tab-pane fade" id="custom-content-addtional_data" role="tabpanel" aria-labelledby="addtional_data">
             Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
          </div>
     
        </div>
       
      </div>
      <!-- /.card -->
    </div>
    <!-- /.card -->


            
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الديانة </button>
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
<script src="{{ asset('assets/admin/js/employees.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection