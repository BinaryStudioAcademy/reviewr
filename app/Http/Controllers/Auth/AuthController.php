<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectAfterLogout;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->redirectAfterLogout = route('home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : route('home');
    }

    public function redirectToBinary()
    {
        return redirect('http://team.binary-studio.com/auth/')->withCookie('referer', 'http://team.binary-studio.com/reviewr/auth/binary_callback');
    }

    public function handleBinaryCallback(Request $request)
    {
        $cookie = $request->cookie('x-access-token');
        //$cookie = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjU1ZGMxMzM5MTg0NmM2OGExYWQ1NmRhYSIsImVtYWlsIjoiYWRtaW5AYWRtaW4iLCJyb2xlIjoiQURNSU4iLCJpYXQiOjE0NDA2NzM4MDV9.rjYkrSZUnBZ1l_eztXgLen-luSq0dsCbMmWW0onCUvo';
        $user   = UserRepository::getUserByCookie($cookie);
        Auth::login($user, false);

        return redirect()->route('home');
    }

    public function redirectToBinaryLogout()
    {
        Auth::logout();
        Session::flush();
        $removeCookie = Cookie::forget('x-access-token');
        return redirect('http://team.binary-studio.com/auth/logout')->withCookie($removeCookie);
    }
}
