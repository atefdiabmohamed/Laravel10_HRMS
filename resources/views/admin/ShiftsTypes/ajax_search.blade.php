@if(@isset($data) and !@empty($data) and count($data)>0 )
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>   نوع الشفت</th>
      <th>  يبدأ من الساعة</th>
      <th>   ينتهي الساعة</th>
      <th>   عدد الساعات</th>
      <th>   حالة التفعيل</th>
      <th>  الاضافة بواسطة</th>
      <th>  التحديث بواسطة</th>
      <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>@if($info->type==1) صباحي @else مسائي  @endif</td>
         <td> 
            @php
            $time=date("h:i",strtotime($info->from_time));
            $newDateTime=date("A",strtotime($info->from_time));
            $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
            @endphp
            {{ $time }}
            {{ $newDateTimeType }}   
         </td>
         <td>
            @php
            $time=date("h:i",strtotime($info->to_time));
            $newDateTime=date("A",strtotime($info->to_time));
            $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
            @endphp
            {{ $time }}
            {{ $newDateTimeType }}   
         </td>
         <td> {{ $info->total_hour*1 }} </td>
         <td @if ($info->active==1) class="bg-success" @else class="bg-danger"  @endif      > @if ($info->active==1) مفعل @else معطل @endif</td>
         <td>
            @php
            $dt=new DateTime($info->created_at);
            $date=$dt->format("Y-m-d");
            $time=$dt->format("h:i");
            $newDateTime=date("A",strtotime($info->created_at));
            $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
            @endphp
            {{ $date }} <br>
            {{ $time }}
            {{ $newDateTimeType }}  <br>
            {{ $info->added->name }} 
         </td>
         <td>
            @if($info->updated_by>0)
            @php
            $dt=new DateTime($info->updated_at);
            $date=$dt->format("Y-m-d");
            $time=$dt->format("h:i");
            $newDateTime=date("A",strtotime($info->updated_at));
            $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
            @endphp
            {{ $date }}  <br>
            {{ $time }}
            {{ $newDateTimeType }}  <br>
            {{ $info->updatedby->name }} 
            @else
            لايوجد
            @endif
         </td>
         <td>
            <a  href="{{ route('ShiftsTypes.edit',$info->id) }}" class="btn btn-success btn-sm">تعديل</a>
            <a  href="{{ route('ShiftsTypes.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<br>
<div class="col-md-12 text-center" id="ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
