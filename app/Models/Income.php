<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    public $guarded = [];
    public function coa()
    {
        return $this->belongsTo(NCOA::class, 'account_code', 'EconSegCode');
    }
}