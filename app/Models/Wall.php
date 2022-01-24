<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wall extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'moderated'
    ];
    
    public function settings(){
        return $this->hasMany(Setting::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
