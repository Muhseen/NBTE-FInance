<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedPayment extends Model
{
    use HasFactory;
    public function voucher()
    {
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }
    public function assigned_to()
    {
        return $this->hasOne(User::class, 'id', 'assign_to');
    }
}