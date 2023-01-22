<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function cr_code()
    {
        return $this->hasOne(NCOA::class, 'EconSegCode', 'account_code_cr');
    }
    public function db_code()
    {
        return $this->hasOne(NCOA::class, 'EconSegCode', 'account_code_db');
    }
}