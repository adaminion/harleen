<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basin extends Model
{
    protected $table = 'basin';
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
