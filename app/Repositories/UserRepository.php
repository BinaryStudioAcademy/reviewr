<?php

namespace App\Repositories;

use DB;
use App\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Tymon\JWTAuth\Token;
use Tymon\JWTAuth\Facades\JWTAuth;
use Prettus\Repository\Criteria\RequestCriteria;

class UserRepository extends PrettusRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByHighestReputation()
    {
        return $this->model->orderBy('reputation', 'desc')->get();
    }

    /**
     * @param $cookie
     *
     * @return static
     */
    public static function getUserByCookie($cookie)
    {
        $tokenObject = new Token($cookie);
        $payload     = JWTAuth::decode($tokenObject);
        $userInfo    = $payload->toArray();

        // temp test user
        $user = User::firstOrCreate([ 'email' => $userInfo['email'] ]);
        $role = array_key_exists('role', $userInfo) ? $userInfo['role'] : "DEVELOPER";
        $user->update([
            'bid'           => $userInfo['id'],
            'role'          => $role,
            'first_name'    => $userInfo['email'], // Temp
            'last_name'     => '', //Temp
            'phone'         => '666-66-666', // Temp
            'avatar'        => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($userInfo['email']))) . '?d=retro',
            'address'       => 'iat: ' . $userInfo['iat'],  // Temp
            'job_id'        => 1,  // Temp
            'department_id' => 1,  // Temp
        ]);

        return $user;
    }
}