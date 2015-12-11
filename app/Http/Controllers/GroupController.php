<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Group::all());
    }
}