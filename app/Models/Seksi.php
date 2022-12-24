<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    //
    protected $table='seksi_has_divisi';

    protected $fillable = [
        'divisi_id', 'seksi_name', 'leader_seksi_name'
    ];
}
