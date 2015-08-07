<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

use App\Services\Interfaces\RequestServiceInterface;

class UserController extends Controller
{
    private $requestService;
    
    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
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
        //return Response::json(\App\User::findOrFail($userId));
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

    public function acceptOfferOnReviewRequest($user_id, $request_id)
    {
        return $this->requestService->acceptUserOfferOnReviewRequest($user_id, $request_id);
    }

    public function declineOfferOnReviewRequest($user_id, $request_id)
    {
        return $this->requestService->declineUserOfferOnReviewRequest($user_id, $request_id);
    }

    public function offerOnReviewRequest($user_id, $request_id)
    {
        return $this->requestService->offerUserOnReviewRequest($user_id, $request_id);
        
        // notification send - MailService call
    }
    
}