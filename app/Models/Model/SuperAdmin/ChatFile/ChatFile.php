<?php

namespace App\Models\Model\SuperAdmin\ChatFile;

use App\Models\Model\SuperAdmin\Chatroom\Chatroom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ChatFile extends Model
{
    use Notifiable;

    protected $fillable=['chat_id','filename','status','order'];

    public function chatroom()
    {
        return $this->belongsTo('App\Models\Model\SuperAdmin\Chatroom\Chatroom','chat_id');
    }

    
}
