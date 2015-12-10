<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use App\Services\Requests\Contracts\RequestServiceInterface;
use App\Services\Interfaces\MailServiceInterface;
use Illuminate\Contracts\Auth\Guard;
use App\Services\Requests\Exceptions\RequestServiceException;

class UserController extends Controller
{
    protected $requestService;
    protected $guard;

    /**
     * @var MailService $mailService
     */
    private $mailService;

    public function __construct(
        RequestServiceInterface $requestService,
        MailServiceInterface $mailService,
        Guard $guard
    ) {
        $this->middleware('auth');

        $this->requestService = $requestService;
        $this->mailService = $mailService;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

    }

    public function acceptReviewRequest($user_id, $request_id)
    {
        $message = $this->requestService->acceptReviewRequest($user_id, $request_id);
        $this->mailService->sendNotification($user_id, $request_id, 'accept');
        return $message;
    }

    public function declineReviewRequest($user_id, $request_id)
    {
        $message = $this->requestService->declineReviewRequest($user_id, $request_id);
        $this->mailService->sendNotification($user_id, $request_id, 'decline');
        return $message;
    }

    public function offerOnReviewRequest($binary_id, $request_id)
    {
        //TODO: Check if authorisation works here (there must be a token)
        $user = $this->guard->user();

        // Checks if the current user id according the id in route
        if (!$binary_id === $user->binary_id) {
            return response()->json(['message'=> 'User mismatched'], 500);
        }

        try {
            $this->requestService->offerOnReviewRequest($user->id, $request_id);
        } catch (RequestServiceException $e) {
            return response()->json(['message'=> $e->getMessage()], 500);
        }

        $this->mailService->sendNotification(
            $user->id,
            $request_id,
            'sent_offer'
        ); // Check if notifications works

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
        $message = $this->requestService->offerOffReviewRequest($user, $request_id);
        return $message;
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

    public function unreadNotifications()
    {
        $user = $this->guard->user();
        return Response::json($this->mailService->unreadNotifications($user->id), 200);
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