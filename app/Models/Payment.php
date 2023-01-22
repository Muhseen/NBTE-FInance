<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    public $guarded = [];
    use HasFactory;
    use SoftDeletes;
    public function voucher()
    {
        return $this->belongsTo(voucher::class, 'voucher_id', 'id');
    }
    public function coa()
    {
        return $this->belongsTo(NCOA::class, 'account_code', 'EconSegCode');
    }
}