<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    use HasFactory;
    protected $table = 'security';
    protected $fillable = [
        'name',
        'code',
        'number_oder',
        'is_block',
        'is_delete',
        'updated_at'
    ];
}
