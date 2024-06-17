<?php

namespace App\Models\Model\SuperAdmin\Chatroom;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Chatroom extends Model
{
    use Notifiable;

    protected $fillable=['sender_id','receiver_id','message','is_read','order'];
     protected function getStatusTextAttribute()
     {
         return  ucwords(str_replace( '_', ' ',$this->status));
     }

    public function getMyDateAttribute(){
         $date = Carbon::parse($this->created_at)->timezone('Asia/Kathmandu')->format('d M, Y h:i A');
         return $date;
    }
    public function chatfiles()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\ChatFile\ChatFile','chat_id');
    }
    
}
