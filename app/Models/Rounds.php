<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rounds extends Model
{
    use HasFactory;

    protected $table = 'rounds';

    protected $fillable = ['rounds'];
    
    // --
    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }
    // --
    public function categories() {
        return $this->hasMany(Categories::class);
    }
}
