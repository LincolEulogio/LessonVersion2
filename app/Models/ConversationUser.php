<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationUser extends Model
{
    protected $table = 'conversation_user';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'conversation_id', 'user_id', 'usertypeID', 'is_sender', 'trash'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }
}
