@extends('layouts.admin')
@section('title')
الادارات
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('departements.index') }}">   الادارات</a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل بيانات ادارة
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('departements.update',$data['id']) }}" method="post">
            @csrf
            <div class="col-md-12">
               <div class="form-group">
                  <label>     اسم الادارة</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>     هاتف الادارة</label>
                  <input type="text" name="phones" id="phones" class="form-control" value="{{ old('phones',$data['phones']) }}"  >
                  @error('phones')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label>     ملاحظات علي  الادارة</label>
                  <input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes',$data['notes']) }}"  >
                  @error('notes')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          
            <div class="col-md-12">
               <div class="form-group">
                  <label> حالة التفعيل</label>
                  <select name="active" id="active" class="form-control">
                  <option @if(old('active',$data['active'])==1) selected @endif  value="1">مفعل</option>
                  <option  @if(old('active',$data['active'])==0) selected @endif  value="0">معطل</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">تعديل الادارة </button>
                  <a href="{{ route('departements.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection