<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン時のバリデーション
     * 
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => 'required|string|max:255|email',
                'password' => 'required|string|min:8|max:255|regex:/^[a-zA-Z0-9]+$/',
            ],
            [
                'password.regex' => ':attributeは半角英数字で入力してください。',
            ],
        );
    }

    /**
     * ソーシャルログイン画面に遷移
     * 
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * ソーシャルログイン
     * 
     * @param Request $request, string $provider
     * @return RedirectResponse
     */
    public function handleProviderCallback(Request $request, string $provider)
    {
        // ユーザー情報取得
        $providerUser = Socialite::driver($provider)->stateless()->user();
        $user = User::where('email', $providerUser->getEmail())->first();

        // 既にアカウントがあればそのままログイン
        if($user) {
            $this->guard()->login($user, true);
            return $this->sendLoginResponse($request);
        }

        // アカウントがなければ登録画面に遷移
        return redirect()->route('register.{provider}', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $providerUser->token,
        ]);
    }

    /**
     * ゲストログイン
     * 
     * @return RedirectResponse
     */
    // ゲストユーザー情報
    private const GUEST_USER_ID = 1;

    public function guestLogin()
    {
        if(Auth::loginUsingId(self::GUEST_USER_ID)) {
                return redirect($this->redirectPath());
            //     // return redirect()->route('articles.index');
        }
    }

    /**
     * ログアウト時の遷移先を変更
     * 
     * @return RedirectResponse
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}
