<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance_calender extends Model
{
    use HasFactory;
    protected $table="finance_calenders";
    protected $fillable=[
        'FINANCE_YR', 'FINANCE_YR_DESC', 'start_date', 'end_date', 'is_open', 'com_ocode', 'added_by', 'updated_by', 'created_at', 'updated_at'

    ];

}
