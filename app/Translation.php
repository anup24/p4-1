<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public function sourcelanguage()
    {
        return $this->belongsTo('App\Sourcelanguage');
    }

    public function targetlanguage()
    {
        return $this->belongsTo('App\Targetlanguage');
    }
}
