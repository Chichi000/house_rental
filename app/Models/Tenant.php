<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, softDeletes;

    public $table = 'tenants';
    public $timestamps = true;
    protected $guarded = ['id', 'imagePath'];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'imagePath',
        'email',
        'password' 
    ];

    public static $rules = [
        'first_name' =>'required',
        'last_name' =>'required',
        'phone' =>'required|numeric',
        'address' =>'required',
        'imagePath' =>'required|image|mimes:jpeg,png,jpg,gif,svg',
        'email' =>'required|email',
        'password' => 'required|min:8'
    ];
    
    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order', 'id');
    }
}
