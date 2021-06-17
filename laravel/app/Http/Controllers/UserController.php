<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $user->fill($request->all());

        // 画像アップロード処理
        if($request->has('profile_image')) {
            $fileName = $this->saveProfileImage($request->file('profile_image'));
            $user->profile_image = $fileName;
        }

        $user->save();

        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * 画像をリサイズ・保存
     * 
     * @param UploadedFile $file
     * @return string ファイル名
     */
    private function saveProfileImage(UploadedFile $file)
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(130,130)->save($tempPath);
        $filePath = Storage::disk('public')->putFile('profile_images', new File($tempPath));

        return basename($filePath);
    }

    /**
     * 一時的なファイル名を生成
     * 
     * @return string パス名
     */
    private function makeTempPath()
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta['uri'];
    }

    /**
     * いいねした投稿を一覧表示
     * 
     * @param User $user
     * @return view
     */
    public function likes(User $user)
    {
        $articles = $user->likes->sortByDesc('created_at');
        
        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    /**
     * フォロー追加処理
     * 
     * @param Request $request, User $user
     * @return Array
     */
    public function follow(Request $request, User $user)
    {
        if($user->id === $request->user()->id) {
            return abort('404', '自分をフォローすることはできません。');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['user' => $user];
    }

    /**
     * フォロー削除処理
     * 
     * @param Request $request, User $user
     * @return Array
     */
    public function unfollow(Request $request, User $user)
    {
        if($user->id === $request->user()->id) {
            return abort('404', '自分をフォローすることはできません。');
        }

        $request->user()->followings()->detach($user);

        return ['user' => $user];
    }
}
