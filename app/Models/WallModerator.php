<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WallModerator extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'wall_id', 'permissions'
    ];
}
