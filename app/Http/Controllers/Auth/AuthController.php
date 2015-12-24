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
use App\Services\RemoteDataGrabber\Contracts\DataGrabberInterface;
use App\Services\RemoteDataGrabber\Exceptions\RemoteDataGrabberException;

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
        $this->middleware('auth', ['except' => ['getLogin']]);

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
        $referer = url(env('APP_PREFIX', '') . '/');

        if ($request->has('redirect')) {
            $referer = $referer . '#' . $request->get('redirect');
        }

        $redirectToAuth = Response::json(
            ['redirectTo' => url(env('AUTH_REDIRECT'))],
            302
        )->withCookie('referer', $referer);

        if(!empty($cookie)) {
            try {
                $this->authService->loginByCookie(
                    $request->cookie('x-access-token')
                );
            } catch (TokenInCookieExpiredException $e) {
                return Redirect::to(env('AUTH_REDIRECT'))
                    ->withCookie('referer', $referer);
            } catch (AuthException $e) {
                // Redirect to the authorisation server if user is not authorised
                return $redirectToAuth;
            }
        } else {
            return $redirectToAuth;
        }

        return Redirect::intended();
    }


    public function getUser()
    {
        $user = $this->authService->getUser();
        return Response::json($user, 200, [], JSON_NUMERIC_CHECK);
    }

    public function getLogout(
        Request $request,
        DataGrabberInterface $dataGrabber
    )
    {
        $cookie = $request->cookie('x-access-token');
        $redirect = Redirect::to(url($this->redirectAfterLogout));

        try {
            $this->authService->logout();

            $logoutResult = (array)$dataGrabber->getFromJson(
                url(env('AUTH_LOGOUT')),
                [CURLOPT_COOKIE => 'x-access-token=' . $cookie]
            );
        } catch (AuthException $e) {
            $redirect =  Redirect::to(url(env('AUTH_LOGOUT')))
                ->withCookie(
                    'x-access-token',
                    url(env('APP_PREFIX', '') . '/')
                );
        } catch (RemoteDataGrabberException $e) {
            $redirect = Redirect::to(url(env('AUTH_LOGOUT')))
                ->withCookie(
                    'x-access-token',
                    url(env('APP_PREFIX', '') . '/')
                );
        }

        Session::flush(); // I don't know if this is neccesary
        return $redirect;

        // Use in case of ajax query and redirecting from the front-end
        //return Response::json($logoutResult, 200, null, JSON_NUMERIC_CHECK);
    }
}
