<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Carbon\carbon;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

class Kelas extends Authenticatable
{
   use HasFactory, SanctumHasApiTokens, Notifiable;


    /**
     * fillable
     *
     * @var array
     */

     protected $guard_name = 'jadwal_harian';
     protected $table = 'jadwal_harian';

     protected $fillable = [
        'jenis_kelas',
        'harga_kelas',
        'jumlah_kapasitas_kelas',
     ];

}
