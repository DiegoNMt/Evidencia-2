<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // Relationship with Users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
