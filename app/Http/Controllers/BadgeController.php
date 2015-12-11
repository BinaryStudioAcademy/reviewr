<?php

namespace App\Http\Controllers;

use App\Badge;
use Illuminate\Support\Facades\Response;

class BadgeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Badge::all());
    }
}