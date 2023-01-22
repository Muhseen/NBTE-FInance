<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NPA extends Model
{
    use HasFactory;
    public $guarded = [];
    public $table = 'npas';
    public function retirements()
    {
        return $this->hasMany(NPARetirement::class, 'npa_id', 'id');
    }
}