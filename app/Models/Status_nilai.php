<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status_nilai extends Model
{
    //
    protected $table='status_nilai_karyawan';

    protected $fillable = [
        'user_id_ternilai','form_id', 'status_kemampuan_kerja', 'status_disiplin', 'status_attitude','nilai_akhir'
    ];
}
