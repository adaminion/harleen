<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:developer,administrator');
    }

    public function index()
    {
        return view('resources.index');
    }
}
