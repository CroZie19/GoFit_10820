<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// // use Laravel\Sanctum\HasApiTokens;
// use Laravel\Passport\HasApiTokens;
// use Carbon\carbon;


class Jadwal_Harian extends Authenticatable
{
   use HasFactory, HasApiTokens , Notifiable;


    /**
     * fillable
     *
     * @var array
     */

     protected $table = 'jadwal_harian';

     protected $fillable = [
        'status_kelas_harian',
        'tanggal_kelas_harian',
     ];

}
     

