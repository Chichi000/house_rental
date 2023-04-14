<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    public $table = 'conversations';

    public function message()
    {
        return $this->hasMany(Message::class,'conversation_id');
    }


    public function user_1_reference()
    {
        return $this->belongsTo(User::class,'user_1');
    }


    public function user_2_reference()
    {
        return $this->belongsTo(User::class,'user_2');
    }
}
