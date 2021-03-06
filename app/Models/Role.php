<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Get the list of user wich have the role.
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
