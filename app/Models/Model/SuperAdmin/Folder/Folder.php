<?php

namespace App\Models\Model\SuperAdmin\Folder;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
   protected $fillable=['parent_id','client_id','title','show_title','order'];
    
    public function childs()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\Folder\Folder','parent_id');
    }
    public function files()
    {
        return $this->hasMany('App\Models\Model\SuperAdmin\File\File','folder_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Model\SuperAdmin\User\User','client_id');
    }
}
