<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Services\Requests\Contracts\RequestServiceInterface;

class TagController extends Controller
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
        return Response::json($this->requestService->getAllTags(), 200);
    }

    public function search(Request $request)
    {
        return Response::json($this->requestService->searchTagsByKeyWord($request->keyword), 200);
    }

    public function popularTags()
    {
        return Response::json($this->requestService->getPopularTags(), 200);
    }
}