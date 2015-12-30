<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcf extends Model
{
    protected $table = 'gcf';

    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * Play yang memiliki GCF tersebut.
     *
     * @return  Play
     */
    public function plays()
    {
        return $this->belongsTo('App\Gcf');
    }
}
