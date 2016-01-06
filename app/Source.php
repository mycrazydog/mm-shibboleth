<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    //
    protected $table = 'sources';
    
    protected $fillable = array('name');
    
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
    
}
