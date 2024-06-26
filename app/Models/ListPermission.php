<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPermission extends Model
{
    use HasFactory;
    protected $table="listpermission";
    protected $fillable = [
        'user_id',
        'security_id',
        'updated_at',
        'active_date',
        'expri_date',
    ];
}
