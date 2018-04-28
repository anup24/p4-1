<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sourcelanguage extends Model
{
    public function translations()
    {
        return $this->hasMany('App\Translation');
    }
}
