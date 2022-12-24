<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    //
    protected $table='nilai_karyawan';

    protected $fillable = [
        'form_id','user_id_ternilai', 'user_id_penilai', 'faktor_id', 'bobot', 'nilai', 'jumlah', 'tahun', 'periode'
    ];
}
