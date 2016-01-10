<?php

namespace App\Quinzel\Repository;

use App\User;
use App\Play;
use App\Lead;
use App\Drillable;
use App\Postdrill;
use App\Discovery;

class LeadRepository
{
    public function index($workingAreaId)
    {
        $leads = Lead::with('gcf')
            ->where('working_area_id', $workingAreaId)
            ->orderBy('updated_at', 'created_at')
            ->get();

        return $leads->each(function ($item, $key) {
            $play = Play::with('gcf')->find($item->play_id);
            $item->play_name = createPlayName(
                $play->gcf->res_litho,
                $play->gcf->res_formation,
                $play->gcf->res_formation_level,
                $play->gcf->res_age_period,
                $play->gcf->res_age_epoch,
                $play->gcf->res_dep_env,
                $play->gcf->trp_type
            );
        });
    }
}