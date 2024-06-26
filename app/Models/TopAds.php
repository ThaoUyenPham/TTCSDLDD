<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopAds extends Model
{
    use HasFactory;
    protected $table = 'topads';
    protected $fillable = [
        'name',
        'is_block',
        'is_delete',
        'describe',
        'number_oder',
        'level',
        'link',
        'code',
        'create_date',
        'active_date',
        'expire_date',
        // 'user_id',
        'updated_at'
    ];
}
