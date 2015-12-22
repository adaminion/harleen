<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeveloperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:developer');
    }

    public function index()
    {
        return view('developer.index');
    }
}
