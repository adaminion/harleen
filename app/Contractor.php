<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $table = 'contractor';

    protected $fillable = [
        'contractor_name',
        'business_entity',
        'holding',
    ];

    public $timestamps = false;

    /**
     * Wilayah kerja yang dimiliki oleh kontraktor.
     *
     * @return  WorkingArea
     */
    public function workingAreas()
    {
        return $this->belongsToMany('App\WorkingArea');
    }
}
