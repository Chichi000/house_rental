<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $table = 'reviews';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'property_id',
        'comment',
    ];

    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function properties(){
        return $this->belongsTo('App\Models\Property', 'property_id');
    }
}
