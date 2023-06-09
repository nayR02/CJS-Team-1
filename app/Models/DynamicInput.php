<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicInput extends Model
{
    use HasFactory;
    protected $table = 'dynamic_input';
    protected $fillable = [
        'name',
        'value',
    ];
}
