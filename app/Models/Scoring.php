<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoring extends Model
{
    use HasFactory;
    protected $table = 'tabulation';
    protected $fillable = ['score'];

    public function candidate()
    {
        return $this->belongsTo(configuration_model::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
    
}
