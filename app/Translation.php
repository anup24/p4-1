<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public function sourcelanguages()
    {
        return $this->belongsTo('App\Sourcelanguage');
    }

    public function targetlanguages()
    {
        return $this->belongsTo('App\Targetlanguage');
    }
}
