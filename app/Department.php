<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    
    /**
     * Get the post that owns the staff.
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_department');
    }
}
