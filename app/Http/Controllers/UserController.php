<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use App\Services\Requests\Contracts\RequestServiceInterface;
use Illuminate\Contracts\Auth\Guard;
use App\Services\Requests\Exceptions\RequestServiceException;

class UserController extends Controller
{
    protected $requestService;
    protected $guard;

    public function __construct(
        RequestServiceInterface $requestService,
        Guard $guard
    ) {
        $this->requestService = $requestService;
        $this->guard = $guard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json($this->requestService->getAllUsers(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($userId)
    {
        return Response::json($this->requestService->getOneUserById($userId), 200);
    }

    public function acceptReviewRequest($author_id, $request_id)
    {
        $message = $this->requestService->acceptReviewRequest($author_id, $request_id);
        return response()->json(['message'=> 'success'], 200);
    }

    public function declineReviewRequest($author_id, $request_id)
    {
        $this->requestService->declineReviewRequest($author_id, $request_id);
        return response()->json(['message'=> 'User mismatched'], 500);
    }

    public function offerOnReviewRequest($binary_id, $request_id)
    {
        //TODO: Check if authorisation works here (there must be a token)
        $user = $this->guard->user();
        $reviewRequest = $this->requestService->getOneRequestById($request_id);

        // Checks if the current user id according the id in route
        if (!$binary_id === $user->binary_id) {
            return response()->json(['message'=> 'User mismatched'], 500);
        }

        try {
            $this->requestService->offerOnReviewRequest($user->id, $request_id);
        } catch (RequestServiceException $e) {
            return response()->json(['message'=> $e->getMessage()], 500);
        }

        return response()->json(['message'=> 'success'], 200);
    }

    public function myRequests()
    {
        $user = $this->guard->user();
        return response()->json(['message' => $user->requests], 200);
    }

    public function offerOffReviewRequest($request_id)
    {
        $user = $this->guard->user();
        $this->requestService->offerOffReviewRequest($user, $request_id);

        response()->json(['message'=> 'success'], 200);
    }

    public function highRept()
    {
        return Response::json($this->requestService->getHighestReputationUsers(), 200);
    }

    public function checkNotification()
    {
        $user = $this->guard->user();
        $count = $user->notifications->count();

        return Response::json($count, 200);
    }

    public function mailAcceptReviewRequest($hashUser, $hashReq)
    {
        $user_id =  Crypt::decrypt($hashUser);
        $req_id =  Crypt::decrypt($hashReq);
        $this->acceptReviewRequest($user_id, $req_id);

        return redirect()->route('home');
    }

    public function  mailDeclineReviewRequest($hashUser, $hashReq)
    {
        $user_id =  Crypt::decrypt($hashUser);
        $req_id =  Crypt::decrypt($hashReq);
        $this->acceptReviewRequest($user_id, $req_id);

        return redirect()->route('home');
    }
}