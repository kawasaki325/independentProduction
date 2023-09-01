<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Time extends Model
{
    use HasFactory;

    protected $fillable = ['goal_id', 'time'];

    // timeを保持するgoalを取得
    public function goal()
    {
        return $this->belongsTo(Time::class);
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->attributes['time']);
    }
}
