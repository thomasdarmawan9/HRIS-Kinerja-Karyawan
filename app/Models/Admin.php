<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
   use HasApiTokens, Notifiable, HasRoles;
   protected $table='admins';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
    'NIP', 'jabatan','name', 'email', 'password',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
     'password', 'remember_token',
   ];


   protected $casts = [
     'email_verified_at' => 'datetime',
   ];
   
   public function Role()
   {
      return $this->hasOne('App\Models\Model_has_role','model_id');
   }
}
