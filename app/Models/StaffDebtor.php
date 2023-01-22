<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDebtor extends Model
{
    use HasFactory;
    public $guarded = [];
    public function npas()
    {
        return $this->hasMany(NPA::class, 'staff_id', 'id');
    }
}