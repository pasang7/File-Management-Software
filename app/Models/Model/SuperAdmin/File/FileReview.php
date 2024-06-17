<?php

namespace App\Models\Model\SuperAdmin\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class FileReview extends Model
{
    use SoftDeletes, Notifiable;

    protected $fillable=['staff_id','file_id','title','remark'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\Model\SuperAdmin\User\User','staff_id');
    }
    public function reviewToUser()
    {
        return $this->belongsTo('App\Models\Model\SuperAdmin\User\User','review_to');
    }
}
