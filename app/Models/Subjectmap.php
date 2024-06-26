<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjectmap extends Model
{
    use HasFactory;
    protected $table = 'subjectmap';
    protected $fillable = [
        'name',
        'summary',
        'is_block',
        'is_delete',
        'srs',
        'bbox',
        'discription',
        'year',
        'zoomin',
        'level',
        'thumbnail',
        'create_date',
        'active_date',
        'expri_date',
        'number_oder',
        'category_id',
        'view',
        'district_id',
        'updated_at'
    ];
}
