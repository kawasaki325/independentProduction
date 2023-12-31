<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items() {
        return $this->hasMany(Item::class);
    }

    // ユーザーが保持するgoalを取得
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    // userとgoalの中間テーブルのためのリレーション
    public function likedGoals()
    {
        return $this->belongsToMany(Goal::class, 'likes')->withTimestamps();
    }

    // フォローに関する中間テーブル
    public function followers()
    {
        return $this->belongsToMany(self::class, "followers", "followed_id", "following_id")->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, "followers", "following_id", "followed_id")->withTimestamps();
    }
}
