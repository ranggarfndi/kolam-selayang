<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'content', 'thumbnail', 'published_at'];
    
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi ke User (Admin)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
