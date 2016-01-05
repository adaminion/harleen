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
            'play' => new Play,
            'gcf' => new Gcf,
            'submitButtonText' => 'Save new Play'
        ]);
    }

    public function update($playId)
    {
        $play = Play::find($playId);
        $gcf = Gcf::find($play->gcf_id);

        return view('play.form', [
            'play' => $play,
            'gcf' => $gcf,
            'submitButtonText' => 'Update Play'
        ]);
    }

    public function store(PlayFormRequest $request)
    {
        $gcf = new Gcf($request['gcf']);
        $gcf->save();
        $play = new Play($request['play']);
        $play->working_area_id = $request->user()->working_area_id;
        $play->gcf_id = $gcf->id;
        $play->save();

        return redirect('play');
    }
}
