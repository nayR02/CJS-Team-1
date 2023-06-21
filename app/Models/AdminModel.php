<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'user_admin';
    protected $fillables = ['username', 'password'];

    public function isAdmin()
    {
        // Assuming you have a 'role' column in your users table
        return $this->role === 'admin';
    }
}
