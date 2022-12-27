<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_has_role extends Model
{
    //
    protected $table='model_has_roles';

    public function admins()
    {
       return $this->hasOne('App\Models\Admin', 'id');
    }
}
