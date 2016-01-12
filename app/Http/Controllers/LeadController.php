<?php

namespace App\Http\Controllers;

use Gate;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LeadFormRequest;
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
            'playList' => PlayRepository::collection($this->workingAreaId),
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
    public function store(LeadFormRequest $request)
    {
        $lead = new Lead($request['lead']);
        $lead->working_area_id = $this->workingAreaId;
        $lead->rps_year = DB::table('sys_year')
            ->where('is_active', '=', 1)
            ->value('rps_year');
        if ($this->workingAreaId !== 'WK1047') {
            $lead->basin_name = DB::table('basin_working_area')
                ->where('working_area_id', '=', $this->workingAreaId)
                ->value('basin_name');
        }

        $gcf = new Gcf($request['gcf']);

        DB::transaction(function() use ($lead, $gcf) {
            $gcf->save();
            $lead->gcf_id = $gcf->id;
            $lead->save();
        });

        session()->flash('success', 'Lead successfully created, thank you!');
        return redirect('lead');
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
