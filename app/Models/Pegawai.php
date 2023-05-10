<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
// use Laravel\Passport\HasApiTokens;
use Carbon\carbon;

class Pegawai extends Authenticatable
{
   use HasFactory, HasApiTokens, Notifiable, HasRoles;

    /**
     * fillable
     *
     * @var array
     */

     protected $guard_name = 'web';
     protected $table = 'pegawai';

     protected $fillable = [
        'nama_pegawai',
        'username_pegawai',
        'password_pegawai',
        'tanggal_lahir_pegawai',
        'noTelp_pegawai',
        'alamat_pegawai',
        'jabatan_pegawai',

     ];
 
}
