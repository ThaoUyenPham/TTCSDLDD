<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerMap extends Model
{
    use HasFactory;
    protected $table = 'layermap';
    protected $fillable = [
        'name',
        'is_nen',
        'is_block',
        'is_delete',
        'lable',
        'number_oder',
        'nativesrs_id',
        'subjectmap_id',
        'systemgeo_id',
        'default',
        'updated_at'
    ];
}
