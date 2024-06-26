<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'ser';
    protected $fillable = [
        'name',
        'category_id',
        'is_block',
        'is_delete',
        'number_oder',
        'updated_at'
    ];
}
