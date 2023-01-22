<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherCheckLog extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'voucher_id', 'status'];
}