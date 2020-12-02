<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scategory extends Model
{
    public $timestamps = false;

    public function services() {
      return $this->hasMany('App\Service');
    }
}
