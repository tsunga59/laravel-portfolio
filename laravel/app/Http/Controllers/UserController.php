<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // 他ユーザーによる操作対策
        if($user->id === Auth::id()) {
            return view('users.edit', ['user' => $user]);
        }

        return redirect()->back();
    }

    /**
     * プロフィールの更新処理
     * 
     * @param ProfileRequest $request, User $user
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, User $user)
    {
        $user->fill($request->all())->save();

        return redirect()->route('users.show', ['user' => $user]);
    }
}
