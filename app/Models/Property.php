<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'properties';
    public $timestamps = true;
    protected $guarded = ['id', 'imagePath'];


    public function landlords()
    {
        return $this->belongsTo('App\Models\Landlord', 'landlord_id');
    }

    protected $fillable = [
        'landlord_id',
        'area',
        'garage',
        'bathroom',
        'bedroom',
        'rent',
        'city',
        'state',
        'address',
        'description',
        'imagePath'
    ];

    public static $rules = [
        'landlord_id',
        'area' => 'required',
        'garage' => 'required|numeric',
        'bathroom' => 'required|numeric',
        'rent' => 'required|numeric',
        'city' => 'required',
        'state' => 'required',
        'address' => 'required',
        'description' => 'required',
        'imagePath' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    ];

    public function reviews()
    {
        return $this->hasOne('App\Models\Review', 'property_id');
    }
    
    public function orders() {
        return $this->belongsToMany(Order::class,'orderline','orderinfo_id','property_id');
    }    

    // public function orders( ) {
    //     return $this->belongsToMany('App\Models\Order', 'id');
    // }
}
