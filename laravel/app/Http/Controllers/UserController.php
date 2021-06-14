<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 投稿の詳細を表示
     * 
     * @param Article $article
     * @return view
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }
}
