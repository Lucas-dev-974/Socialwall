<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'platform', 'platform_post_id', 'user_id',
        'hashtag', 'have_media', 'state'
    ];
}
