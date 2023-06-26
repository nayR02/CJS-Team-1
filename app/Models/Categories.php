<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['category_name', 'category_value'];

    public function rounds()
    {
        return $this->belongsTo(Rounds::class);
    }
    public function criteria() {
        return $this->hasMany(Criteria::class);
    }
    public function scoring() {
        return $this->hasMany(Scoring::class);
    }
}
