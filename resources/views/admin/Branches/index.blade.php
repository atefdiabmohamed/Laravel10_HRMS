@extends('layouts.admin')
@section('title')
الفروع
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('branches.index') }}">   الفروع</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات  الفروع 
            <a href="{{ route('branches.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
         </h3>
      </div>
      <div class="card-body">
         @if(@isset($data) and !@empty($data) )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>  كود الفرع</th>
               <th>  الاسم</th>
               <th>   العنوان</th>
               <th>   الهاتف</th>
               <th>   الايميل</th>
               <th>   حالة التفعيل</th>
               <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td> {{ $info->id }} </td>
                  <td> {{ $info->name }} </td>
                  <td> {{ $info->address }} </td>
                  <td> {{ $info->phones }} </td>
                  <td> {{ $info->email }} </td>
                  <td @if ($info->active==1) class="bg-success" @else class="bg-danger"  @endif      > @if ($info->active==1) مفعل @else معطل @endif</td>
                  <td>{{ $info->added->name }} </td>
                  <td>
                     @if($info->updated_by>0)
                     {{ $info->updatedby->name }} 
                     @else
                     لايوجد
                     @endif
                  </td>
                  <td>
                     <a  href="{{ route('branches.edit',$info->id) }}" class="btn btn-success btn-sm">تعديل</a>
                     <a  href="{{ route('branches.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
