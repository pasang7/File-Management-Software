<?php

namespace App\Models\Model\SuperAdmin\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class File extends Model
{
    use SoftDeletes, Notifiable;

    protected $fillable=['user_id','user_role','client_id','title','filename','remark','status','order','folder_id'];
     protected function getStatusTextAttribute()
     {
         return  ucwords(str_replace( '_', ' ',$this->status));
     }
    public function user()
    {
        return $this->belongsTo('App\Models\Model\SuperAdmin\User\User','user_id');
    }
    public function reviews()
    {
        return $this->hasMany(FileReview::class);
    }
}
