<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ChatServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    private $chatService;

    public function __construct(ChatServiceInterface $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return Response::json($this->chatService->getAllCommentsByRequest($id), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, $rid)
    {
        return Response::json($this->chatService->addComment($request, $rid), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json($this->chatService->getOneCommentById($id), 200);
    }
}