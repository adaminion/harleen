<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcf extends Model
{
    protected $table = 'gcf';

    protected $guarded = ['id'];

    public $timestamps = false;

    public $nice = [
        'src_data' => 'Proven or analog'
    ];

    /**
     * Play yang memiliki GCF tersebut.
     *
     * @return  Play
     */
    public function play()
    {
        return $this->hasOne('App\Play');
    }
}
