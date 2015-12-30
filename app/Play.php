<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    protected $table = 'play';

    protected $guarded = [
        'id',
        'working_area_id',
        'gcf_id',
        'rps_year',
        'created_at',
        'updated_at',
        'deleted_at',
        'update_reason',
        'delete_reason',
        'is_editing',
    ];

    public $timestamps = false;

    /**
     * Mengambil wilayah kerja yang memiliki Play tersebut.
     *
     * @return  WorkingArea
     */
    public function workingAreas()
    {
        return $this->belongsTo('App\WorkingArea');
    }

    /**
     * GCF yang dimiliki oleh Play.
     *
     * @return  Gcf
     */
    public function Gcfs()
    {
        return $this->hasOne('App\Gcf');
    }
}
