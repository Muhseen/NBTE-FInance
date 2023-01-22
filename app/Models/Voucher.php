<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    public $guarded = [];
    public $appends = ['payable'];
    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by', 'id');
    }
    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by', 'id');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
    public function payment_approval()
    {
        return $this->belongsTo(ApprovedPayment::class, 'id', 'voucher_id');
    }
    public function user_to_check()

    {
        return $this->belongsToMany(User::class, 'voucher_checks');
    }
    public function minutes()
    {
        return $this->hasMany(VoucherMinutes::class);
    }
    public function getPayableAttribute()
    {
        return $this->amount - ($this->vat + $this->stamp + $this->wht);
    }
}