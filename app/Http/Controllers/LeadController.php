<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quinzel\Repository\PlayRepository;
use App\Quinzel\Repository\LeadRepository;

use App\Play;
use App\Lead;
use App\Gcf;

class LeadController extends Controller
{
    /**
     * WKID yang sedang aktif.
     *
     * @var array
     */
    protected $workingAreaId;

    /**
     * LeadRepository instance.
     *
     * @var LeadRepository
     */
    protected $repo;

    /**
     * Buat controller instance baru.
     *
     * @param  LeadRepository
     * @return void
     */
    public function __construct(LeadRepository $repo)
    {
        $this->middleware('shared');
        $this->middleware('role:contractor');

        $this->workingAreaId = request()->user()->working_area_id;
        $this->repo = $repo;
    }

    /**
     * List Lead yang dimiliki oleh kontraktor.
     *
     * @return View
     */
    public function index()
    {
        return view('lead.index', [
            'data' => $this->repo->collection($this->workingAreaId)
        ]);
    }

    /**
     * Melihat satu record Lead.
     *
     * @param  $id Lead ID
     * @return View
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        $play = Play::findOrFail($lead->play_id);

        if (Gate::denies('access-lead', $lead)) {
            abort(404);
        }

        $gcf = Gcf::find($lead->gcf_id);

        return view('lead.form', [
            'lead' => $lead,
            'gcf' => $gcf,
            'url' => null,
            'method' => 'get',
        ]);
    }

    /**
     * Membuat record Lead baru.
     *
     * @return View
     */
    public function create()
    {
        return view('lead.form', [
            'playList' => PlayRepository::collection($this->workingAreaId),
            'lead' => new Lead,
            'gcf' => new Gcf,
            'url' => url('lead'),
            'method' => 'post',
            'submitButtonText' => 'Save new Lead'
        ]);
    }

    /**
     * Menyimpan record Lead baru ke database.
     *
     * @return View
     */
    public function store()
    {
        $play = new Play($request['play']);
        $play->working_area_id = $this->workingAreaId;
        $play->rps_year = DB::table('sys_year')
            ->where('is_active', '=', 1)
            ->value('rps_year');
        if ($this->workingAreaId !== 'WK1047') {
            $play->basin_name = DB::table('basin_working_area')
                ->where('working_area_id', '=', $this->workingAreaId)
                ->value('basin_name');
        }

        $gcf = new Gcf($request['gcf']);

        DB::transaction(function() use ($play, $gcf) {
            $gcf->save();
            $play->gcf_id = $gcf->id;
            $play->save();
        });

        session()->flash('success', 'Play successfully created, thank you!');
        return redirect('play');
    }

    /**
     * AJAX call, Mengambil data GCF pada Play tertentu.
     *
     * @return JSON
     */
    public function getPlayGcf()
    {
        return PlayRepository::detail(request('playId'));
    }
}
