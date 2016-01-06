<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Gate;
use App\Http\Requests;
use App\Http\Requests\PlayFormRequest;
use App\Http\Controllers\Controller;
use App\Quinzel\Repository\PlayRepository;

use App\Play;
use App\Gcf;
use App\Basin;

class PlayController extends Controller
{
    /**
     * WKID yang sedang aktif.
     *
     * @var array
     */
    protected $workingAreaId;

    /**
     * PlayRepository instance.
     *
     * @var PlayRepository
     */
    protected $repo;

    /**
     * Buat controller instance baru.
     *
     * @param  PlayRepository
     * @return void
     */
    public function __construct(PlayRepository $repo)
    {
        $this->middleware('shared');
        $this->middleware('role:contractor');

        $this->workingAreaId = request()->user()->working_area_id;
        $this->repo = $repo;
    }

    public function index()
    {
        return view('play.index', [
            'data' => $this->repo->index($this->workingAreaId)
        ]);
    }

    public function show($id)
    {
        $play = Play::findOrFail($id);
        $gcf = Gcf::find($play->gcf_id);

        return view('play.form', [
            'play' => $play,
            'gcf' => $gcf,
            'url' => null,
            'method' => 'get',
        ]);
    }

    public function create()
    {
        return view('play.form', [
            'play' => new Play,
            'gcf' => new Gcf,
            'url' => url('play'),
            'method' => 'post',
            'submitButtonText' => 'Save new Play'
        ]);
    }

    public function store(PlayFormRequest $request)
    {
        $play = new Play($request['play']);
        $gcf = new Gcf($request['gcf']);

        if ($this->workingAreaId !== 'WK1047') {
            $play->basin_name = DB::table('basin_working_area')
                ->where('working_area_id', '=', $this->workingAreaId)
                ->value('basin_name');
        }

        $gcf->save();
        $play->working_area_id = $this->workingAreaId;
        $play->gcf_id = $gcf->id;
        $play->save();

        return redirect('play');
    }

    public function edit($id)
    {
        $play = Play::findOrFail($id);
        $gcf = Gcf::find($play->gcf_id);

        if (Gate::denies('update-play', $play)) {
            abort(404);
        }

        return view('play.form', [
            'play' => $play,
            'gcf' => $gcf,
            'url' => url('play', [$play->id]),
            'method' => 'put',
            'submitButtonText' => 'Save updated Play'
        ]);
    }

    public function update(PlayFormRequest $request, $id)
    {
        $play = Play::findOrFail($id);
        $gcf = Gcf::find($play->gcf_id);

        if (Gate::denies('update-play', $play)) {
            abort(404);
        }

        if ($this->workingAreaId !== 'WK1047') {
            $play->basin_name = DB::table('basin_working_area')
                ->where('working_area_id', '=', $this->workingAreaId)
                ->value('basin_name');
        }

        $play->update($request['play']);
        $gcf->update($request['gcf']);

        return redirect('play');
    }

    public function destroy($id)
    {
        // TODO: Check if play can be deleted.
        Play::find($id)->delete();

        return redirect('play');
    }
}
