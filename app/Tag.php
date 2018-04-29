<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function translations()
    {
        return $this->belongsToMany('App\Translation')->withTimestamps();
    }
}
