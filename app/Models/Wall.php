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

    public function views(){
        return $this->hasMany(Views::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function suspectWords(){
        return $this->hasMany(SuspectWords::class);
    }

    public function blockedUsers(){
        return $this->hasMany(BlockedUsers::class);
    }

}
