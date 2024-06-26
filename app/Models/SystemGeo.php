<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemGeo extends Model
{
    
    use HasFactory;
    protected $table = 'systemgeo';
    protected $fillable = [
        'name',
        'linkurl',
        'is_block',
        'is_delete',
        'default',
        'number_oder',
        'workspace',
        'username',
        'password',
        'updated_at'
    ];
}
