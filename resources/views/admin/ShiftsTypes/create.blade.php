@extends('layouts.admin')
@section('title')
الشفتات
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('ShiftsTypes.index') }}">   الشفتات</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة  شفت جديد
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('ShiftsTypes.store') }}" method="post">
            @csrf
            <div class="col-md-12">
               <div class="form-group">
                  <label> نوع الشفت </label>
                  <select name="type" id="type" class="form-control">
                     <option value="">اختر النوع</option>
                     <option @if(old('type')==1) selected @endif value="1">صباحي</option>
                     <option @if(old('type')==2) selected @endif value="2">مسائي</option>
                     <option @if(old('type')==3) selected @endif value="3"> يوم كامل</option>
                  </select>
                  @error('type')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="form-group">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>   يبدأ من الساعة </label>
                     <input type="time" name="from_time" id="from_time" class="form-control" value="{{ old('from_time') }}" >
                     @error('from_time')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>   ينتهي  الساعة </label>
                     <input type="time" name="to_time" id="to_time" class="form-control" value="{{ old('to_time') }}" >
                     @error('to_time')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label>    عدد الساعات</label>
                  <input type="text" name="total_hour" id="total_hour" class="form-control" value="{{ old('total_hour') }}" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" >
                  @error('total_hour')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label> حالة التفعيل</label>
                  <select  name="active" id="active" class="form-control">
                  <option   @if(old('active')==1) selected @endif  value="1">مفعل</option>
                  <option @if(old('active')==0 and old('active')!='') selected @endif value="0">معطل</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الشفت </button>
                  <a href="{{ route('ShiftsTypes.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection