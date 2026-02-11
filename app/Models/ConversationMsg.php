<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationMsg extends Model
{
    protected $table = 'conversation_msg';
    protected $primaryKey = 'msg_id';

    protected $fillable = [
        'conversation_id', 'user_id', 'subject', 'msg', 'attach', 
        'attach_file_name', 'usertypeID', 'create_date', 'modify_date', 'start'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }
}
