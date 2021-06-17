<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'profile_image',
        'self_introduction',
        'wakeup_time',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'wakeup_time_range',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    // ユーザーの投稿数を取得
    public function getCountArticlesAttribute()
    {
        return $this->articles->count();
    }

    public function likes()
    {
        return $this->belongsToMany('App\Models\Article', 'likes')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    // ユーザーのフォロー有無を判定
    public function hasFollowed(?User $user)
    {
        if($user) {
            return (bool)$this->followers->where('id', $user->id)->count();
        }
        return false;
    }

    // フォロー数を取得
    public function getCountFollowingsAttribute()
    {
        return $this->followings->count();
    }
    
    // フォロワー数を取得
    public function getCountFollowersAttribute()
    {
        return $this->followers->count();
    }

}
