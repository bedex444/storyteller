<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeMine($query)
    {
        $user = auth()->user();

        return $user && !$user->is_admin ? $query->where('user_id', $user->id) : $query;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
