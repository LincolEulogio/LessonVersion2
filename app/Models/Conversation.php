<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $fillable = [
        'status', 'draft', 'fav_status', 'create_date', 'modify_date'
    ];

    public function messages()
    {
        return $this->hasMany(ConversationMsg::class, 'conversation_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(ConversationUser::class, 'conversation_id', 'id');
    }
}
