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
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات السنوات المالية 
 <a href="{{ route('finance_calender.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>

         </h3>
      </div>
      <div class="card-body">
     @if(@isset($data) and !@empty($data) )
     <table id="example2" class="table table-bordered table-hover">
        <thead class="custom_thead"> 
        <th> كود السنة</th>   
        <th> وصف السنة</th>     
        <th>  تاريخ البداية</th>   
        <th>  تاريخ النهاية</th>   
        <th>  الاضافة بواسطة</th> 
        <th>  التحديث بواسطة</th> 
        <th></th>
        
        </thead>
        <tbody>
@foreach ( $data as $info )
   <tr> 
    <td> {{ $info->FINANCE_YR }} </td>
    <td> {{ $info->FINANCE_YR_DESC }} </td>
    <td> {{ $info->start_date }} </td>
    <td> {{ $info->end_date }} </td>
    <td>{{ $info->added->name }} </td>
    <td>
    @if($info->updated_by>0)
    <td>{{ $info->updatedby->name }} </td>
    @else
 لايوجد
    @endif
    </td>
    <td>
    @if($info->is_open==0)
    <a  href="{{ route('finance_calender.edit',$info->id) }}" class="btn btn-success btn-sm">تعديل</a>
    <a  href="{{ route('finance_calender.destroy',$info->id) }}" class="btn btn-danger btn-sm">حذف</a>
    @else
 سنة مالية مفتوحه
    @endif
        
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