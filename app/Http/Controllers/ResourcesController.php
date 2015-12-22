<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quinn\Resources;

class ResourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:developer,administrator');
    }

    public function index()
    {
        $resources = Resources::montageTable();
        return view('resources.index', ['resources' => $resources]);
    }
}
