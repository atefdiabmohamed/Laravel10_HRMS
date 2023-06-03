@extends('layouts.admin')
@section('title')
السنوات المالية
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('finance_calender.index') }}">  السنوات المالية</a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل سنة مالية    
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('finance_calender.update',$data['id']) }}" method="post">
            @csrf
            @method('PUT')
            <div class="col-md-12">
               <div class="form-group">
                  <label> كود السنة المالية</label>
                  <input type="text" name="FINANCE_YR" id="FINANCE_YR" class="form-control" value="{{old('FINANCE_YR',$data['FINANCE_YR'])  }}"    >
                  @error('FINANCE_YR')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label> وصف السنة المالية</label>
                  <input type="text" name="FINANCE_YR_DESC" id="FINANCE_YR_DESC" class="form-control" value="{{ old('FINANCE_YR_DESC',$data['FINANCE_YR_DESC']) }}" >
                  @error('FINANCE_YR_DESC')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label> تاريخ بداية السنة المالية</label>
                  <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date',$data['start_date']) }}" >
                  @error('start_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label> تاريخ نهاية السنة المالية</label>
                  <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date',$data['end_date']) }}" >
                  @error('end_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">تحديث السنة </button>
                  <a href="{{ route('finance_calender.index') }}" class="btn btn-sm btn-danger">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection