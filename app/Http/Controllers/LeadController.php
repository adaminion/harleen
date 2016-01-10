<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quinzel\Repository\LeadRepository;

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
}
