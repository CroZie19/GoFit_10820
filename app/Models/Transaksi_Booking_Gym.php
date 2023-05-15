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

class Transaksi_Booking_Gym extends Authenticatable
{
   use HasFactory, SanctumHasApiTokens, Notifiable;


    /**
     * fillable
     *
     * @var array
     */

      protected $table = 'transaksi__booking__gym';
      protected $primaryKey = 'id_booking_gym';
      public $incrementing = false;
      // protected $keyType  =  'string'
     protected $fillable = [
      //   'id_booking_gym',
        'sesi_gym',
        'jumlah_kapasitas_gym',
        'tanggal_booking_gym',
     ];
}