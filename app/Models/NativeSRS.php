<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NativeSRS extends Model
{
    use HasFactory;
    protected $table = 'nativesrs';
    protected $fillable = [
        'auth_name',
        'srtext',
        'proj4text',
        'auth_srid'
    ];
}
