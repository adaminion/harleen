<?php

namespace App;

use Carbon\Carbon;
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

    /**
     * Custom fields.
     *
     * @param  \App\Lead $lead
     * @return Eloquent
     */
    public static function addCustomFields($lead)
    {
        // Coordinate
        $latitude = explode(',', $lead->latitude);
        $longitude = explode(',', $lead->longitude);

        $lead->latitude_degree = $latitude[0];
        $lead->latitude_minute = $latitude[1];
        $lead->latitude_second = $latitude[2];
        $lead->latitude_cardinal = $latitude[3];

        $lead->longitude_degree = $longitude[0];
        $lead->longitude_minute = $longitude[1];
        $lead->longitude_second = $longitude[2];

        // Lead initiate date
        $initiate = explode('-', $lead->initiate);

        $lead->initiate_year = $initiate[0];
        $lead->initiate_month = $initiate[1];
        $lead->initiate_day = $initiate[2];

        return $lead;
    }
}
