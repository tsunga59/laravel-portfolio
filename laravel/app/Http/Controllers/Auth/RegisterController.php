<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  UserRequest $request
     * @return RedirectResponse
     */
    protected function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->guard()->login($user);
        return redirect($this->redirectPath());
    }

    /**
     * ソーシャル登録画面を表示
     * 
     * @param Request $request, string $provider
     * @return view
     */
    public function showProviderUserRegistrationForm(Request $request, string $provider)
    {
        $token = $request->token;
        $providerUser = Socialite::driver($provider)->userFromToken($token);

        return view('auth.social-register', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $token,
        ]);
    }

    /**
     * ソーシャル登録
     * 
     * @param Request $request, string $provider
     * @return RedirectResponse
     */
    public function registerProviderUser(Request $request, string $provider)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'token' => 'required|string',
        ]);

        $token = $request->token;
        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $user = User::create([
            'name' => $request->name,
            'email' => $providerUser->getEmail(),
            'password' => null,
        ]);

        $this->guard()->login($user, true);
        return redirect($this->redirectPath());
    }
}
