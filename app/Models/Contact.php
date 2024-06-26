<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'name',
        'discribe',
        'district',
        'active',
        'email',
        'title',
        'created_at',
        'is_delete'
    ];
}
