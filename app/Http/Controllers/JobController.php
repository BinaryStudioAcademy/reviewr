<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Support\Facades\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Job::all());
    }
}