<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = ['goal_id', 'content'];

    // placeを保持するgoalを取得
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
