
@if(@isset($finance_cln_periods) and !@empty($finance_cln_periods) )
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>  اسم الشهر عربي</th>
      <th>  اسم الشهر انجليزي</th>
      <th>  تاريخ البداية</th>
      <th>  تاريخ النهاية</th>
      <th>   عدد الايام</th>
      <th>    حالة الشهر</th>
      <th>  الاضافة بواسطة</th>
      <th>  التحديث بواسطة</th>
     
   </thead>
   <tbody>
      @foreach ( $finance_cln_periods as $info )
      <tr>
         <td> {{ $info->Month->name }} </td>
         <td> {{ $info->Month->name_en }} </td>
         <td> {{ $info->START_DATE_M }} </td>
         <td> {{ $info->END_DATE_M }} </td>
         <td> {{ $info->number_of_days }} </td>
          <td> @if($info->is_open==1) مفتوح @elseif ($info->is_open==2) مؤرشف @else  مغلق @endif</td>

         <td>{{ $info->added->name }} </td>
         <td>
            @if($info->updated_by>0)
        {{ $info->updatedby->name }} 
         @else
         لايوجد
         @endif
         </td>
      
      </tr>
      @endforeach
   </tbody>
</table>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
