<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use App\Services\Auth\Contracts\AuthServiceInterface;
use App\Services\Auth\Exceptions\AuthException;
use App\Services\Auth\Exceptions\TokenInCookieExpiredException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use App\Repositories\Contracts\UserRepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Services\Auth\Contracts\UserUpdater;
use App\Services\Auth\Exceptions\UpdatingFailureException;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Auth\Guard;

class AuthService implements AuthServiceInterface
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $email;
    protected $password;
    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;
    protected $userUpdater;
    protected $guard;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserUpdater $userUpdater,
        Guard $guard
    ) {
        $this->userRepository = $userRepository;
        $this->userUpdater = $userUpdater;
        $this->guard = $guard;
    }

    /*
     * Only local logout
     */
    public function logout()
    {
        try {
            $this->guard->logout();
        } catch(\Exception $e) {
            $errorMessage = $e->getMessage() . ' Logout error. User is not authorized.';
            Log::error($errorMessage);
            throw new AuthException($errorMessage, null, $e);
        }
    }

    public function getUser()
    {
        if ($this->guard->check()) {
            return $this->userRepository->findWithRelations($this->guard->id());
        } else {
            throw new AuthException('User is not authorized');
        }
    }

    public function loginByCookie($cookie)
    {
        $user = $this->createOrUpdateUserByCookie($cookie);

        // Login
        $this->guard->login($user, true);

        // Return an actual user model if login passes
        if ($this->guard->check()) {
            return $this->userRepository->find($this->guard->id());
        } else {
            $errorMessage = 'Login error. User is not authorized. (binary_id: ' . $user->binary_id . ')';
            Log::error($errorMessage);
            throw new AuthException($errorMessage);
        }
    }

    protected function extractUserDataFromCookie($cookie)
    {
        $tokenObject = new Token($cookie);

        // Get a payload info from the token
        try {
            $payload = JWTAuth::decode($tokenObject);
        } catch (TokenExpiredException $e) {
            $message = 'Token in cookie was expired';
            throw new TokenInCookieExpiredException($message, null, $e);
        }

        return $payload;
    }

    /*
     * Get user by the payload info
     */
    protected function createOrUpdateUserByCookie($cookie)
    {
        $userPayload = $this->extractUserDataFromCookie($cookie);

            try {
            $user = $this->userUpdater->updateBaseInfo($userPayload);
        } catch (RepositoryException $e) {
            throw new AuthException($e->getMessage(), null, $e);
        }

        // Attempt to update his profile by API or just log the error
        try {
            $user = $this->userUpdater
                ->updateAdditionalInfo($cookie, $user);
        } catch (UpdatingFailureException $e) {
            Log::warning(
                'An additional info of the user (binary_id:'
                . $user->binary_id
                . ' ) information was\'nt updated. '
                . $e->getMessage()
            );
        }

        return $user;
    }

    public function updateUser(array $data, $id)
    {
        try {
            $user = $this->userRepository->update($data, $id);
        } catch (RepositoryException $e) {
            Log::warning(
                'An additional info of the user (id:'
                . $id
                . ' ) information was\'nt updated. '
                . $e->getMessage()
            );

            throw new AuthException(
                $e->getMessage(),
                null,
                $e
            );
        }

        return $user;
    }

    /**
     * @param int|null $pageSize
     * @return mixed
     */
    public function getAllUsers($pageSize = null)
    {
        try {
            $users = $this->userRepository
                ->with('localRole')
                ->with('globalRole')
                ->paginate($pageSize);
        } catch (RepositoryException $e) {
            throw new AuthException(
                $e->getMessage() . ' Cannot return the users list.',
                null,
                $e
            );
        }

        return $users;
    }
}