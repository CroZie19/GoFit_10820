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
use Spatie\Permission\Traits\HasRoles;

class Instruktur extends Authenticatable
{
    use HasFactory, SanctumHasApiTokens, Notifiable, HasRoles;

    /**
     * fillable
     *
     * @var array
     */

     protected $guard_name = 'instruktur';
     protected $table = 'instruktur';


     protected $fillable = [
        'nama_instruktur',
        'username_instruktur',
        'password_instruktur',
        'tanggal_lahir_instruktur',
        'noTelp_instruktur',
        'alamat_instruktur'
     ];

}
