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
use App\Quinzel\PlayRepository;

class PlayController extends Controller
{
    /**
     * PlayRepository instance.
     *
     * @var PlayRepository
     */
    protected $repository;

    /**
     * PlayFormRequest instance.
     *
     * @var PlayFormRequest
     */
    protected $formRequest;

    protected $validator;

    /**
     * Buat controller instance baru.
     *
     * @param  PlayRepository
     * @return void
     */
    public function __construct(PlayRepository $repository, PlayFormRequest $form)
    {
        $this->middleware('auth');
        $this->middleware('role:contractor');

        $this->repository = $repository;
        $this->formRequest = $form;
    }

    public function index()
    {
        return view('play.index', [
            'data' => $this->repository->index(request()->user())
        ]);
    }

    public function create()
    {
        return view('play.create', [
            'mPlay' => new Play,
            'mGcf' => new Gcf,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'play.basin_name' => 'required',
            'gcf.basin_name' => 'required',
            'gcf.src_data' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('play/create')
                ->withErrors($validator)
                ->withInput();
        }

        return false;
    }
}
