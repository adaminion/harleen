<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:contractor');
    }

    public function index()
    {
        $data = DB::table('play')
            ->select([
                'play.basin_name',
                'gcf.res_litho as litho',
                'gcf.res_formation as formation',
                'gcf.res_formation_level as formation_lvl',
                'gcf.res_age_period as age_period',
                'gcf.res_age_epoch as age_epoch',
                'gcf.res_dep_env as env',
                'gcf.trp_type as trap'
            ])
            ->leftJoin('gcf', 'play.gcf_id', '=', 'gcf.id')
            ->where('working_area_id', '=', request()->user()->working_area_id)
            ->get();

        return view('play.index', ['data' => $data]);
    }

    public function create()
    {
        return view('play.create');
    }
}
