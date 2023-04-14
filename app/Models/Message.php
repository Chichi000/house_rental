<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $table = 'messages';

    public function conversation()
    {
        return $this->belongsTo(Conversation::class,'conversation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'message_sender_user');
    }
}
