<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [
        'name',
        'is_block',
        'is_delete',
        'number_oder',
        'level',
        'code',
        'parent_id',
        'updated_at'
    ];
    protected $casts = [
        'parent_id' => 'integer',
         'number_oder' => 'integer', 
         'level' => 'integer',
    ];
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
