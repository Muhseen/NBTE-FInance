<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    public $fillable = ['projection', 'actual', 'approved', 'released', 'committed'];
    public function code()
    {
        return $this->belongsTo(NCOA::class, 'account_code', 'EconSegCode');
    }
}