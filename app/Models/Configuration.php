<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $table = 'event_configurations';
    protected $fillable = ['start_date', 'end_date', 'event_name', 'venue'];
   
}
