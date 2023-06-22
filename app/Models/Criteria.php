<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    protected $table = 'criterias';

    protected $fillable = ['criteria_name', 'criteria_value'];
    
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function scores()
    {
        return $this->hasMany(Scoring::class);
    }
}
