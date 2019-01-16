<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    protected $fillable = ['name','description','genre','releaseDate','image'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
