<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\RequestServiceInterface;
use App\Services\Interfaces\MailServiceInterface;
use App\User;

class UserController extends Controller
{
    private $requestService;
    private $mailService;
    public function __construct(RequestServiceInterface $requestService, MailServiceInterface $mailService)
    {
        $this->requestService = $requestService;
        $this->mailService = $mailService;
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
     * @param  int  $id
     * @return Response
     */
    public function show($userId)
    {
        return Response::json($this->requestService->getOneUserById($userId), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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

    public function offerOnReviewRequest($user_id, $request_id)
    { 
        $user_id = Auth::user()->id;
        $message = $this->requestService->offerOnReviewRequest($user_id, $request_id);
        $this->mailService->sendNotification($user_id, $request_id, 'sent_offer');
        return $message;
    }

    public function myRequests()
    {   
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return response()->json(['message'=> $user->requests], 200);
    }

    public function offerOffReviewRequest($request_id)
    {
        $user = Auth::user();
        $message = $this->requestService->offerOffReviewRequest($user, $request_id);
        return $message;
    }

    public function highRept()
    { 
        return Response::json($this->requestService->getHighestReputationUsers(), 200);
    }

    public function checkNotification()
    {   
        $user = Auth::user();
        $count = $user->notifications->count();
        return Response::json($count, 200);
        // while(true) {
        //     $currentCount = $user->notifications->count();
        //     if ($count < $currentCount || $count > $currentCount) {
        //         return Response::json($currentCount, 200);
        //     }
        //      else {
        //         sleep(5);
        //         $currentCount = $user->notifications->count();
        //         continue;

        //      }


        // }       
    }
}