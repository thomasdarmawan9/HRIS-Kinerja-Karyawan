<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
   protected $table='admins';

   use HasApiTokens, Notifiable, HasRoles;

   /**
    * The attributes that are mass assignable.
    * @var array
    */
   protected $fillable = [
     'name', 'email', 'password',
   ];

   /**
    * The attributes that should be hidden for arrays.
    * @var array
    */
   protected $hidden = [
     'password', 'remember_token',
   ];


   protected $casts = [
     'email_verified_at' => 'datetime',
   ];

   // Rest omitted for brevity

   /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
   public function getJWTIdentifier()
   {
      return $this->getKey();
   }

   /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
   public function getJWTCustomClaims()
   {
      return [];
   }

}
