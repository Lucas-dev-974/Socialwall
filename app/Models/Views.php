<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'wall_id', 'date', 'views' 
    ];

    public function wall(){
        return $this->belongsToMany(Wall::class);
    }
}
