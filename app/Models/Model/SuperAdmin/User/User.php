<?php

namespace App\Models\Model\SuperAdmin\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';
    protected $fillable=['name','username','role','status','phone',
    'address','image','password', 'decrypt_pw','email', 'verification_code', 'pan_no', 'designation'];
    protected function getStatusTextAttribute()
    {
        return  ucwords(str_replace( '_', ' ',$this->status));
    }
    public function getUserRoleAttribute(){
        if($this->role == 'admin'){
            return 'Admin';
        }elseif ($this->role =='staff'){
            return 'Staff';
        }else{
            return 'Client';
        }
    }
    public function getUserImageAttribute(){
        if($this->image == ''){
            return '1.png';
        }else{
            return $this->image;
        }
    }
    public function folders()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\Folder\Folder','client_id');
    }
    public function files()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\File\File','client_id');
    }
    public function sendChats()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\Chatroom\Chatroom','sender_id');
    }
    
    public function receiveChats()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\Chatroom\Chatroom','receiver_id');
    }

}
