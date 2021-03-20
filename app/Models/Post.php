<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body'
    ];

    public function scopeChronological($query)
    {
        return $query->orderBy('created_at','DESC');
    }

    public function scopeList($query)
    {
        return $query->chronological()->get();
    }

    /**
     * get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
