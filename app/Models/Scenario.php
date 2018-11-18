<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    //
    public function buttons()
    {
        return $this->belongsToMany('App\Models\InlineButton')->withPivot('line', 'order');;
    }

}
