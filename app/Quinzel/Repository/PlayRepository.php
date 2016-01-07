<?php

namespace App\Quinzel\Repository;

use App\User;
use App\Play;
use App\Lead;
use App\Drillable;
use App\Postdrill;
use App\Discovery;

class PlayRepository
{
    public function index($workingAreaId)
    {
        $plays = Play::with('gcf')
            ->where('working_area_id', $workingAreaId)
            ->orderBy('updated_at', 'created_at')
            ->get();

        return $plays->each(function ($item, $key) {
            $item->name = createPlayName(
                $item->gcf->res_litho,
                $item->gcf->res_formation,
                $item->gcf->res_formation_level,
                $item->gcf->res_age_period,
                $item->gcf->res_age_epoch,
                $item->gcf->res_dep_env,
                $item->gcf->trp_type
            );
        });
    }

    /**
     * Mencari Lead yang dimiliki oleh Play pada wilayah kerja
     * tertentu.
     *
     * @param  int $playId Play ID
     * @param  string $workingAreaIid
     * @param  boolean $withDeleted Termasuk Lead yang sudah dihapus
     * @return \Illuminate\Support\Collection
     */
    public function findLead($playId, $workingAreaId, $withDeleted = false)
    {
        $data = Lead::where([
            'play_id' => $playId,
            'working_area_id' => $workingAreaId
        ]);

        if ($withDeleted) {
            $data->withTrashed();
        }

        return $data->get();
    }

    /**
     * Mencari Drillable yang dimiliki oleh Play pada wilayah kerja
     * tertentu.
     *
     * @param  int $playId Play ID
     * @param  string $workingAreaIid
     * @param  boolean $withDeleted Termasuk Drillable yang sudah dihapus
     * @return \Illuminate\Support\Collection
     */
    public function findDrillable($playId, $workingAreaId, $withDeleted = false)
    {
        $data = Drillable::where([
            'play_id' => $playId,
            'working_area_id' => $workingAreaId
        ]);

        if ($withDeleted) {
            $data->withTrashed();
        }

        return $data->get();
    }

    /**
     * Mencari Postdrill yang dimiliki oleh Play pada wilayah kerja
     * tertentu.
     *
     * @param  int $playId Play ID
     * @param  string $workingAreaIid
     * @param  boolean $withDeleted Termasuk Postdrill yang sudah dihapus
     * @return \Illuminate\Support\Collection
     */
    public function findPostdrill($playId, $workingAreaId, $withDeleted = false)
    {
        $data = Postdrill::where([
            'play_id' => $playId,
            'working_area_id' => $workingAreaId
        ]);

        if ($withDeleted) {
            $data->withTrashed();
        }

        return $data->get();
    }

    /**
     * Mencari Discovery yang dimiliki oleh Play pada wilayah kerja
     * tertentu.
     *
     * @param  int $playId Play ID
     * @param  string $workingAreaIid
     * @param  boolean $withDeleted Termasuk Discovery yang sudah dihapus
     * @return \Illuminate\Support\Collection
     */
    public function findDiscovery($playId, $workingAreaId, $withDeleted = false)
    {
        $data = Discovery::where([
            'play_id' => $playId,
            'working_area_id' => $workingAreaId
        ]);

        if ($withDeleted) {
            $data->withTrashed();
        }

        return $data->get();
    }
}