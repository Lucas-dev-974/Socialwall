<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsWall extends Model
{
    use HasFactory;
    protected $table = 'postswall';
    protected $fillable = [
        'post_id', 'wall_id', 'blocked'
    ];
}
