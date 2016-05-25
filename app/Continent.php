<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    //
    protected $table = 'Continent';
    protected $primaryKey='Id';

    public function country()
{
    return $this->belongsTo('App\Country', 'Id');
}
}
