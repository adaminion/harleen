<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingArea extends Model
{
    protected $table = 'working_area';

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
     * Wilayah kerja dimiliki oleh banyak kontraktor dengan satu operator.
     *
     * @return  Contractor
     */
    public function contractors()
    {
        return $this->belongsToMany('App\Contractor', 'contractor_working_area');
    }

    /**
     * Wilayah kerja memiliki banyak Play.
     *
     * @return  Play
     */
    public function plays()
    {
        return $this->hasMany('App\Play');
    }
}
