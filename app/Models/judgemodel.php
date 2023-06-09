<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class judgemodel extends Model
{
    use HasFactory;
    
    protected $table = "judge_configurations";

    protected $fillable = ["judge_name","username","password"];
}
