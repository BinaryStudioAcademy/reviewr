<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Support\Facades\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Department::all());
    }
}