<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function achievements()
    {
        return $this->hasMany('App\Models\Achievement');
    }

    // ユーザーの朝活達成日数を取得
    public function getCountAchievementsAttribute()
    {
        return $this->achievements
            ->where('date', '>=', Carbon::now()->startOfMonth()->toDateString())
            ->where('date', '<=', Carbon::now()->endOfMonth()->toDateString())
            ->count();
    }

    // ユーザーの朝活達成率を取得
    public function getCalcAchievementsAttribute()
    {
        // 月の途中にアカウント作成した場合、月の合計日数を調整
        if(
            Carbon::parse($this->created_at) >= Carbon::now()->startOfMonth()
            && Carbon::parse($this->created_at) <= Carbon::now()->endOfMonth()
        ) {
            // アカウント作成日と月の合計日数の差分を取得
            $totalDays =  Carbon::parse($this->created_at)->diffInDays(Carbon::now()->endOfMonth());
        } else {
            $totalDays = date('t');
        }
        
        $achievementDays =  $this->getCountAchievementsAttribute();

        return round($achievementDays / $totalDays * 100, 1);
    }

    // 朝活達成日数ランキングを取得
    public function achievementsRanking()
    {
        // 上位5名のユーザーを順番に取得
        $ranked_users = User::withCount(['achievements' => function($query) {
            $query->where('date', '>=', Carbon::now()->startOfMonth()->toDateString())
            ->where('date', '<=', Carbon::now()->endOfMonth()->toDateString());
        }])
            ->having('achievements_count', '>', 0)
            ->orderBy('achievements_count', 'desc')
            ->limit(5)
            ->get();

        // 上位ユーザーのランキング順位を取得(同率の場合は、同じ順位を繰り返す)
        if(!empty($ranked_users)) {
            $rank = 1;
            $previousUser = $ranked_users->first();

            $ranked_users->each(function($user) use (&$previousUser, &$rank) {
                if($previousUser->achievements_count > $user->achievements_count) {
                    $rank++;
                    $previousUser = $user;
                }
                $user->rank = $rank;
                return $user;
            });
        }

        return $ranked_users;
    }
}
