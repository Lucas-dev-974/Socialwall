<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedUsers extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'platform_user_id', 'wall_id' 
    ];

    public function wall(){
        return $this->belongsToMany(Wall::class);
    }
}
