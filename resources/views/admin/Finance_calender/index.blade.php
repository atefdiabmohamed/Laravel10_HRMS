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
                  {{ $info->updatedby->name }} 
                  @else
                  لايوجد
                  @endif
                  </td>
                  <td>
                     @if($info->is_open==0)
                      @if($CheckDataOpenCounter==0)
                     <a  href="{{ route('finance_calender.do_open',$info->id) }}" class="btn btn-primary btn-sm">فتح</a>
                    @endif
                     <a  href="{{ route('finance_calender.edit',$info->id) }}" class="btn btn-success btn-sm">تعديل</a>
                     <a  href="{{ route('finance_calender.delete',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a>
                     <button class="btn btn-sm btn-info show_year_monthes" data-id="{{ $info->id }}"  >عرض الشهور</button>
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

<div class="modal fade " id="show_year_monthesModal" >
   <div class="modal-dialog modal-xl">
     <div class="modal-content bg-info">
       <div class="modal-header">
         <h4 class="modal-title">عرض الشهور  للسنة المالية</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
       </div>
       <div class="modal-body" id="show_year_monthesModalBody">
  
       </div>
       <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-outline-light">Save changes</button>
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>

@endsection
@section('script')
<script>
   $(document).ready(function(){
      $(document).on('click','.show_year_monthes',function(){
    var id=$(this).data('id');
    jQuery.ajax({
   url:'{{ route('finance_calender.show_year_monthes') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{ "_token":'{{ csrf_token() }}','id':id },
   success:function(data){
   $("#show_year_monthesModalBody").html(data);
   $("#show_year_monthesModal").modal("show");
   },
   error:function(){
   
   }
   
    });
   
   
      });
   });
   
   
</script>
@endsection