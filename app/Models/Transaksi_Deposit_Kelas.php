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

class Transaksi_Deposit_Kelas extends Authenticatable
{
   use HasFactory, SanctumHasApiTokens, Notifiable;


    /**
     * fillable
     *
     * @var array
     */

     protected $fillable = [
        'tanggal_transaksi_deposit_kelas',
        'jumlah_deposit_kelas',
        'total_pembayaran_deposit_kelas',
        'bonus_deposit_kelas',
     ];

}
