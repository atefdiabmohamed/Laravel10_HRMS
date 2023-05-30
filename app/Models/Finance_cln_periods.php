<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance_cln_periods extends Model
{
    use HasFactory;

    protected $table="finance_cln_periods";
    protected $fillable=[
        'finance_calenders_id', 'number_of_days', 'year_and_month', 'FINANCE_YR', 'MONTH_ID', 'START_DATE_M', 'END_DATE_M', 'is_open', 'start_date_for_pasma', 'end_date_for_pasma', 'added_by', 'updated', 'com_code', 'created_at', 'updated_at'
    ];
}
