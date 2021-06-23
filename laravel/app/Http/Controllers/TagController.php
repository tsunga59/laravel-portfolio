<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * タグ別の投稿一覧を表示
     * 
     * @param string $name, User $user
     * @return view
     */
    public function show(string $name, User $user)
    {
        $tag = Tag::where('name', $name)->first();

        // 朝活達成ランキングのユーザーを取得
        $ranked_users = $user->achievementsRanking();

        return view('tags.show', [
            'tag' => $tag,
            'ranked_users' => $ranked_users,
        ]);
    }
}
