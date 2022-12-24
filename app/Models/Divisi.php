<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    //
    protected $table='divisi';

    protected $fillable = [
        'name_division', 'leader_team_name'
    ];
}
