<?php

namespace App\Http\Controllers\Mockups;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\stdClass;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->admin = new \stdClass();
        $this->dev   = new \stdClass();
        $this->user   = new \stdClass();

        $this->admin->payloadInfo = [
            'id' => '55dc13391846c68a1ad56daa',
            'email' => 'admin@admin',
            'role' => 'ADMIN',
            'iat' => 1440615292
        ];

        $this->dev->payloadInfo = [
            'id' => '55dd8be1fd5d69885b0bc0c7',
            'email' => 'dev@asciit.local',
            'role' => 'UNKNOWN',
            'iat' => 1441785864
        ];

        $this->user->payloadInfo = [
            'id' => '55dc13391846c68a1ad56da3',
            'email' => 'cypherpunks01@europe.com',
            'role' => 'USER',
            'iat' => 1440615292
        ];

        $this->admin->additionalInfo = [
            'userCV' => '55dcfb51fe77dc367b71d228',
            'userPDP' => '55dcfbb4fe77dc367b71d230',
            'email' => 'igor.oziyanoziyan@gmail.com',
            'password' => '123456789',
            'name' => 'IgorIgorIgor',
            'surname' => 'OziyanOziyanOziyan',
            'country' => 'Ukraine',
            'city' => 'Kyiv',
            'gender' => 'male',
            'birthday' => '1992-12-11T22:00:00.000Z',
            'serverUserId' => '55dc13391846c68a1ad56daa',
            'avatar' => [
                'urlAva' => '/api/files/get/992bd47c-3279-4230-9aee-307e078dbf2d.jpg',
                'thumbnailUrlAva' => 'http://placehold.it/150/dff9f6'
            ],
            'workDate' => '2015-05-11T22:00:00.000Z',
            'isDeleted' => false,
            'changeAccept' => true,
            'preModeration' => [],
            'id' => '55dcfe8cfe77dc367b71d23c',
        ];

        $this->dev->additionalInfo = [
            'userCV' => '55dd8be1fd5d69885b0bc0c7',
            'userPDP' => '55dcfbb4fe77dc367b71d230',
            'email' => 'dev@asciit.local',
            'password' => '123456789',
            'name' => 'Junior Developer',
            'surname' => 'Sherlock Holmes',
            'country' => 'Ukraine',
            'city' => 'Kyiv',
            'gender' => 'male',
            'birthday' => '1992-12-11T22:00:00.000Z',
            'serverUserId' => '55dc13391846c68a1ad56daa',
            'avatar' => [
                'urlAva' => '/api/files/get/992bd47c-3279-4230-9aee-307e078dbf2d.jpg',
                'thumbnailUrlAva' => 'http://placehold.it/150/dff9f6'
            ],
            'workDate' => '2015-05-11T22:00:00.000Z',
            'isDeleted' => false,
            'changeAccept' => true,
            'preModeration' => [],
            'id' => '55dd8be1fd5d69885b0bc0c7',
        ];

        $this->user->additionalInfo = [
            'userCV' => '55dcfb51fe77dc367b71d228',
            'userPDP' => '55dcfbb4fe77dc367b71d230',
            'email' => 'cypherpunks01@europe.com',
            'password' => 'cypherpunks01',
            'name' => 'John',
            'surname' => 'Malkovich',
            'country' => 'Ukraine',
            'city' => 'Kyiv',
            'gender' => 'male',
            'birthday' => '1992-12-11T22:00:00.000Z',
            'serverUserId' => '55dc13391846c68a1ad56daa',
            'avatar' => [
                'urlAva' => '/api/files/get/992bd47c-3279-4230-9aee-307e078dbf2d.jpg',
                'thumbnailUrlAva' => 'http://placehold.it/150/dff9f6'
            ],
            'workDate' => '2015-05-11T22:00:00.000Z',
            'isDeleted' => false,
            'changeAccept' => true,
            'preModeration' => [],
            'id' => '55dc13391846c68a1ad56da3',
        ];

        $this->currentUser = $this->dev;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function auth(Request $request)
    {
        $userData = $this->currentUser->payloadInfo;
        $payload = JWTFactory::make($userData);
        $data = JWTAuth::encode($payload);
        $redirectPath = $request->cookie('referer');

        return Redirect::to($redirectPath, 303)
            ->withCookie('x-access-token', $data->get())
            ->withCookie('serverUID', $userData['id']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function logout()
    {
        setcookie('x-access-token', '', -1, '/');
    }

    public function profile()
    {
        $data = $this->currentUser->additionalInfo;

        return Response::json([$data], 200);
    }
}
