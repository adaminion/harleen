<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * Basin dapat dimiliki oleh banyak wilayah kerja.
     *
     * @return belongsToMany
     */
    public function workingAreas()
    {
        return $this->belongsToMany('App\WorkingAreas');
    }
}
