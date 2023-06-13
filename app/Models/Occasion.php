<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    use HasFactory;
    protected $table = "occasions";
    protected $guarded = [];

    public function added()
    {
        return $this->belongsTo('\App\Models\Admin', 'added_by');
    }
    public function updatedby()
    {
        return $this->belongsTo('\App\Models\Admin', 'updated_by');
    }
}
