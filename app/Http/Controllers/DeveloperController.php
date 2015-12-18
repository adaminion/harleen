<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developer.index');
    }
}
