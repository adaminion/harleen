<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $table = 'lead';

    protected $guarded = [
        'id',
        'working_area_id',
        'gcf_id',
        'rps_year',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_editing',
        'is_pinnded'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Lead dimiliki oleh satu Play.
     *
     * @return belongsTo
     */
    public function play()
    {
        return $this->belongsTo('App\Play');
    }

    /**
     * GCF yang dimiliki oleh Lead.
     *
     * @return belongsTo
     */
    public function gcf()
    {
        return $this->belongsTo('App\Gcf');
    }
}
