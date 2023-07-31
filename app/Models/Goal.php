<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content'];

    
    // goalを保持するuserを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // goalが保持するplaceを取得
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    // goalが保持するtimeを取得
    public function times()
    {
        return $this->hasMany(Time::class);
    }

    // goalが保持するpriceを取得
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
