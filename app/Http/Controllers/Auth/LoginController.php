<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'user_name' => 'required|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            // 该用户存在于数据库，且邮箱和密码相符合
            session()->flash('success', '登录成功');
            return redirect()->route('index');
        } else {
            session()->flash('danger', '很抱歉，您的用户名和密码不匹配');
            return redirect()->back()->withInput();
        }
        return;
    }
}
