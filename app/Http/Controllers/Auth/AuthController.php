<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
        //return redirect('http://team.binary-studio.com/auth/');
    }

    public function handleBinaryCallback(Request $request)
    {
        //$cookie = $request->cookie('x-access-token');
        $cookie = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjU1ZGMxMzM5MTg0NmM2OGExYWQ1NmRhYSIsImVtYWlsIjoiYWRtaW5AYWRtaW4iLCJyb2xlIjoiQURNSU4iLCJpYXQiOjE0NDA2NzM4MDV9.rjYkrSZUnBZ1l_eztXgLen-luSq0dsCbMmWW0onCUvo';
        $tokenObject = new Token($cookie);
        $payload = JWTAuth::decode($tokenObject);
        $userInfo = $payload->toArray();
        /*  $userInfo
        array:8 [?
          "id" => "55dc13391846c68a1ad56daa"
          "email" => "admin@admin"
          "role" => "ADMIN"
          "iat" => 1440673805
          "iss" => "http://reviewr/auth/binary_callback"
          "exp" => "1440843412"
          "nbf" => "1440839812"
          "jti" => "46aee5367a7ad10d82f40057c874e182"
        ]
        */
        // temp test user
        $user = User::firstOrCreate(['email' => $userInfo['email']]);
        $user->update([
            'bid'           => $userInfo['id'],
            'role'          => $userInfo['role'],
            'first_name'    => $userInfo['role'], // Temp
            'last_name'     => str_limit($userInfo['id'], 6, ''), //Temp
            'phone'         => '666-66-666', // Temp
            'avatar'        => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($userInfo['email']))) . '?d=retro',
            'address'       => 'iat: ' . $userInfo['iat'],  // Temp
            'job_id'        => 1,  // Temp
            'department_id' => 1,  // Temp
        ]);

        Auth::login($user, true);

        return redirect()->route('home');
    }
}
