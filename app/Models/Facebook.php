<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'wall_id', 'token', 'username', 'pages', 'facebook_datas'
    ];
}
