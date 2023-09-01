<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['goal_id', 'amount'];

    // priceを保持するgoalを取得
    public function goal()
    {
        return $this->belongsTo(Price::class);
    }

    // transportationを取得するリレーション
    public function transportation()
    {
        return $this->hasOne(Transportation::class);
    }
}
