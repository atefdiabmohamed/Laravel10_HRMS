
<label> المحافظات</label>
<select name="governorates_id" id="governorates_id" class="form-control select2 ">
    <option value="">اختر المحافظة التابع لها الموظف</option>
    @if (@isset($other['governorates']) && !@empty($other['governorates']))
    @foreach ($other['governorates'] as $info )
    <option @if(old('governorates')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }}
    </option>
    @endforeach
    @endif
</select>
@error('governorates_id')
<span class="text-danger">{{ $message }}</span>
@enderror

@section("script")

<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

</script>
@endsection