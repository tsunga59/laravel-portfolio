<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * プロフィールの詳細を表示
     * 
     * @param Article $article
     * @return view
     */
    public function show(User $user)
    {
        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    /**
     * プロフィールの更新画面を表示
     * 
     * @param User $user
     * @return view
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * プロフィールの更新処理
     * 
     * @param UserRequest $request, User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        
    }
}
