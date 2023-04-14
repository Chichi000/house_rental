<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

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

    public function tenants() {
        return $this->hasOne('App\Models\tenant', 'user_id');
    }

    public function landlords() {
        return $this->hasOne('App\Models\landlord', 'user_id');
    }

    public function admins() {
        return $this->hasOne('App\Models\admin', 'user_id');
    }

    public function reviews() {
        return $this->hasOne('App\Models\Review', 'user_id');
    }

    public function user_1_conversation()
    {
        return $this->hasMany(Conversation::class,'user_1' ,'id');
    }

    public function user_2_conversation()
    {
        return $this->hasMany(Conversation::class,'user_2', 'id');
    }
}
