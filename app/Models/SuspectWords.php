<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspectWords extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'word' , 'wall_id'
    ];

    public function wall(){
        return $this->belongsToMany(Wall::class);
    }
}
