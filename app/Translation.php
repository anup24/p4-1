<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Aws\Translate;

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

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
