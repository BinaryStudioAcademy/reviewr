<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Guzzle\Http\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Response;
use App\Services\Auth\Contracts\AuthServiceInterface;
use App\Services\Auth\Exceptions\TokenInCookieExpiredException;
use App\Services\Auth\Exceptions\AuthException;
use Illuminate\Support\Facades\Session;

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
    protected $authService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->redirectAfterLogout = route('home');
        $this->authService = $authService;
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

    public function getLogin(Request $request) {
        $cookie = $request->cookie('x-access-token');

        if(!empty($cookie)) {
            try {
                $user = $this->authService->loginByCookie(
                    $request->cookie('x-access-token')
                );
            } catch (TokenInCookieExpiredException $e) {
                return Redirect::to(env('AUTH_REDIRECT'))
                    ->withCookie(
                        'referer',
                        url(env('APP_PREFIX', '') . '/')
                    );
            } catch (AuthException $e) {
                // Redirect to the authorisation server if user is not authorised
                return Redirect::to(url(env('AUTH_REDIRECT')))
                    ->withCookie(
                        'referer',
                        url(env('APP_PREFIX', '') . '/')
                    );
            }
        } else {
            return Redirect::to(url(env('AUTH_REDIRECT')))
                ->withCookie(
                    'referer',
                    url(env('APP_PREFIX', '') . '/')
                );
        }

        return Redirect::intended();
    }

    public function getLogout(Request $request)
    {
        Session::flush();
        $cookie = $request->cookie('x-access-token');
        setcookie('x-access-token', '', -1, '/');

        return Redirect::to(url(env('AUTH_LOGOUT')))
            ->withCookie('x-access-token', $cookie);
    }
}
