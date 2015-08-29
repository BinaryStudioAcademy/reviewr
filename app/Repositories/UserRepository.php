<?php

namespace App\Repositories;

use App;
use DB;
use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Tymon\JWTAuth\Token;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::orderBy('first_name')->get();
    }

    public function OneById($id)
    {
    	return User::with('job', 'department')->findOrFail($id);
    }

    public function create($data) {}

    public function update($id, $data) {}

    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }

    public function getByHighestReputation()
    {
        return User::orderBy('reputation', 'desc')->get();
    }

    public function unreadNotifications($user)
    {
        $notifications = $user->notifications;
        DB::table('notifications')->where('user_id', $user->id)->delete();
        return $notifications;
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
        $user = User::firstOrCreate([ 'email' => $userInfo['email'] ]);
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

        return $user;
    }


}