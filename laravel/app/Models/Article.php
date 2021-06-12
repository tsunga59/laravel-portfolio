<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    // ログインユーザーのいいね有無を判定
    public function hasLike(?User $user)
    {
        if($user) {
            return $this->likes->where('id', $user->id)->count();
        }
        return false;
    }

    // 投稿のいいね数を取得
    public function getCountLikesAttribute()
    {
        return $this->likes->count();
    }
}
