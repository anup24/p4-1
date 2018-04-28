<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targetlanguage extends Model
{
    public function translations()
    {
        return $this->hasMany('App\Translation');
    }
}
