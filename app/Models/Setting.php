<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'field', 'type', 'value', 'user_id'
    ];

    public function wall(){
        return $this->belongsTo(Wall::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
