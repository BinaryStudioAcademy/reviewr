<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Services\Requests\Contracts\RequestServiceInterface;
use Illuminate\Support\Facades\Auth;

class ReviewRequestController extends Controller
{
    private $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        parent::__construct();
        $this->requestService = $requestService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json($this->requestService->getAllRequests(), 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newReviewRequest = $this->requestService->createRequest($data);

        return Response::json($newReviewRequest, 201, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json($this->requestService->getOneRequestById($id), 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $updatedRequest = $this->requestService->updateRequest($id, $data);

        return $updatedRequest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Response::json($this->requestService->deleteRequestById($id), 200);
    }

    public function offers($id)
    {
        return Response::json($this->requestService->getSpecificRequestOffers($id), 200);
    }

    public function tags($id)
    {
        return Response::json($this->requestService->getSpecificRequestTags($id), 200);
    }

    public function myReviewRequest()
    {
        return Response::json($this->requestService->getMyRequests(), 200);
    }

    public function offeredReviewRequest()
    {
        //dd(Response::json($this->requestService->getOfferedRequests(), 200));
        return Response::json($this->requestService->getOfferedRequests(), 200);
    }

    public function offeredReviewRequests()
    {
        return Response::json($this->requestService->getOfferedReviewRequests_(), 200);
    }

    public function popularReviewRequests()
    {
        return Response::json($this->requestService->getPopularReviewRequests(), 200);
    }

    public function sortReviewRequestsByGroups($group_id)
    {
        return Response::json($this->requestService->getReviewRequestsByGroupId($group_id), 200);
    }
    
    public function usersForRequest($request_id) 
    {
        $users = $this->requestService->usersForRequest($request_id);
        return response()->json(['message'=> $users], 200);
    }

    public function upcomingReviewRequests()
    {
        return Response::json($this->requestService->upcomingReviewRequests(), 200);
    }

    public function lastNReviewRequests($number)
    {
        return Response::json($this->requestService->lastNReviewRequests($number), 200);
    }

    public function upcomingForPeriodReviewRequests($period)
    {
        return Response::json($this->requestService->upcomingForPeriodReviewRequests($period), 200);
    }
    
    public function sortReviewRequestsByTags($tag_id)
    {
        return Response::json($this->requestService->getReviewRequestsByTagId($tag_id), 200);
    }

    public function sortReviewRequestsByUsers($user_id)
    {
        return Response::json($this->requestService->getReviewRequestsByUserId($user_id), 200);
    }
}
