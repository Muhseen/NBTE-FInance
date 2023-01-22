<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NPARetirement extends Model
{
    use HasFactory;
    public $table = "npa_retirements";
    public $guarded = [];
}