<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
            'data' => $this->repo->index($this->workingAreaId)
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
            'play' => $play,
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
            'play' => new Play,
            'lead' => new Lead,
            'gcf' => new Gcf,
            'url' => url('lead'),
            'method' => 'post',
            'submitButtonText' => 'Save new Lead'
        ]);
    }
}
