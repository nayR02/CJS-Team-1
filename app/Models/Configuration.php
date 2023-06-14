<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $table = 'event_configurations';
    protected $fillable = ['date', 'start_time', 'end_time', 'event_name', 'venue'];
   
    public function rounds()
    {
        return $this->hasMany(Rounds::class);
    }
}
