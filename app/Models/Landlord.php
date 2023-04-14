<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Landlord extends Model
{
    use HasFactory, softDeletes;
    public $table = 'landlords';
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

    public function properties(){
        return $this->hasMany('App\Models\Property', 'landlord_id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}