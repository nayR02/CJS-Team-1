<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configuration_model extends Model
{
    use HasFactory;
    
    protected $table = 'candidate_configurations';

    protected $fillable = ['candidate_number', 'candidate_name', 'municipality', 'age', 'profile'];

}

