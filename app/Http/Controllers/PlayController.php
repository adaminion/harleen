<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Http\Requests;
use App\Http\Requests\PlayFormRequest;
use App\Http\Controllers\Controller;
use App\Play;
use App\Gcf;
use App\Quinzel\Repository\PlayRepository;

class PlayController extends Controller
{
    /**
     * PlayRepository instance.
     *
     * @var PlayRepository
     */
    protected $repository;

    /**
     * Buat controller instance baru.
     *
     * @param  PlayRepository
     * @return void
     */
    public function __construct(PlayRepository $repository)
    {
        $this->middleware('auth');
        $this->middleware('role:contractor');

        $this->repository = $repository;
    }

    public function index()
    {
        return view('play.index', [
            'data' => $this->repository->index(request()->user())
        ]);
    }

    public function create()
    {
        return view('play.form', [
            'model' => new Play,
            'submitButtonText' => 'Save new Play'
        ]);
    }

    public function store(PlayFormRequest $request)
    {
        return false;
    }
}
