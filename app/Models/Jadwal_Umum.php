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

class Jadwal_Umum extends Authenticatable
{
   use HasFactory, HasApiTokens, Notifiable, HasRoles;


    /**
     * fillable
     *
     * @var array
     */

    protected $table = 'jadwal_umum';

     protected $fillable = [
        'hari_kelas_umum',
        'jam_kelas_umum',
        'status_kelas_umum',
     ];

}
