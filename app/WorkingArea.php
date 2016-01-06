<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingArea extends Model
{
    protected $table = 'working_area';
    public $incrementing = false;

    protected $fillable = [
        'working_area_name',
        'shore',
        'area_original',
        'stage_original',
        'sign_date',
        'end_date',
    ];

    public $timestamps = false;

    /**
     * Wilayah kerja dapat berada dibanyak basin, meskipun hanya WK Indonesia
     * saja yang berada dibanyak basin.
     *
     * @return  belongsToMany
     */
    public function basins()
    {
        return $this->belongsToMany('App\Basin', 'basin_working_area');
    }

    /**
     * Wilayah kerja dimiliki oleh banyak kontraktor dengan satu operator.
     *
     * @return  belongsToMany
     */
    public function contractors()
    {
        return $this->belongsToMany('App\Contractor', 'contractor_working_area');
    }

    /**
     * Wilayah kerja memiliki banyak Play.
     *
     * @return  hasMany
     */
    public function plays()
    {
        return $this->hasMany('App\Play');
    }
}
