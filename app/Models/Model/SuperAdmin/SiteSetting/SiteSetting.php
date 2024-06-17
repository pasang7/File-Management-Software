<?php

namespace App\Models\Model\SuperAdmin\SiteSetting;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable=['title','email','tel_no','mobile_no','report_email2','report_email3',
        'address','map','report_email4','facebook','instagram','twitter','skype','linkedin',
        'logo_image','seo_title','seo_keywords','seo_description'];
}
