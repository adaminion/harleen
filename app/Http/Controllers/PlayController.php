<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Play;
use App\Quinzel\PlayRepository;

class PlayController extends Controller
{
    /**
     * PlayRepository instance.
     *
     * @var PlayRepository
     */
    protected $plays;

    /**
     * Buat controller instance baru.
     *
     * @param  PlayRepository
     * @return void
     */
    public function __construct(PlayRepository $plays)
    {
        $this->middleware('auth');
        $this->middleware('role:contractor');

        $this->plays = $plays;
    }

    public function index()
    {
        return view('play.index', [
            'data' => $this->plays->index(request()->user())
        ]);
    }

    public function create()
    {
        return view('play.create', ['model' => Play::with('gcf')]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'play.basin_name' => 'required',
            'gcf.basin_name' => 'required',
            'gcf.src_data' => 'required'
        ])->setAttributeNames(['play.basin_name' => 'a']);

        if ($validator->fails()) {
            return redirect('play/create')
                ->withErrors($validator)
                ->withInput();
        }

        return false;
    }
}
