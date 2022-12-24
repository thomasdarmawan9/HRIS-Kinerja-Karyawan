<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    //
    protected $table='kriteria_faktor_penilaian';

    protected $fillable = [
        'kriteria', 'faktor', 'bobot','nilai0', 'nilai1', 'nilai2', 'nilai3', 'nilai4', 'nilai5'
    ];
}
