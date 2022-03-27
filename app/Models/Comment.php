<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function scopeMine($query)
    {
        $user = auth()->user();

        return $user && !$user->is_admin ? $query->whereHas('story', function ($storyQ) use ($user) {
            $storyQ->where('user_id', $user->id);
        }) : $query;
    }
}
