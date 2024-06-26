<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_block',
        'is_delete',
        'number_oder',
        'level',
        'link',
        'thumbnail',
        'code',
        'create_date',
        'active_date',
        'expire_date',

        'updated_at'
    ];

}
