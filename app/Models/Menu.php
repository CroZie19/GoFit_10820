<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = ['web', 'instruktur', 'member'];
    protected $table = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'id_induk',
        'ikon',
        'url',
        'urut',
    ];
}
