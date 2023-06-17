@extends('layouts.admin')
@section('title')
المناسبات الرسمية
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('occasions.index') }}">   المناسبات</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة  مناسبات رسمية
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('occasions.store') }}" method="post">
            @csrf
      
            <div class="col-md-12">
               <div class="form-group">
                  <label>     اسم المناسبة الرسمية</label>
                  <input  type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
           

            <div class="col-md-12">
               <div class="form-group">
                  <label>       تبدأ من تاريخ </label>
                  <input  type="date" name="from_date" id="from_date" class="form-control" value="{{ old('from_date') }}"  >
                  @error('from_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
    
            <div class="col-md-12">
               <div class="form-group">
                  <label>       تنتهي  الي تاريخ </label>
                  <input  type="date" name="to_date" id="to_date" class="form-control" value="{{ old('to_date') }}"  >
                  @error('to_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>       عدد الايام</label>
                  <input  type="text" name="days_counter" id="days_counter" oninput="this.value=this.value.replace(/[^0-9.]/g,'');"  class="form-control" value="{{ old('days_counter') }}"  >
                  @error('days_counter')
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
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف المناسبة </button>
                  <a href="{{ route('occasions.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection