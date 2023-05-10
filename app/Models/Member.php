<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Passport\HasApiTokens;
use Carbon\carbon;
use Spatie\Permission\Traits\HasRoles;

class Member extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, HasRoles;

    /**
     * fillable
     *
     * @var array
     */

     protected $guard_name = 'member';
     protected $table = 'member';

     protected $fillable = [  
      'nama_member',
      'tanggal_lahir_member',
      'alamat_member',
      'noTelp_member',
      'jumlah_deposit_member',
      'email',
      'password',
      'tanggal_kardaluasa_member',
     ];

     
}
