<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'Continent_Country';
    protected $primaryKey='Id';
    
    public function continent() 
    {
        return $this->hasOne('App\Continent', 'Id');
    }
}
