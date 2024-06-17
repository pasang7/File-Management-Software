<?php

namespace App\Http\Controllers\SuperAdmin\SiteSetting;

use App\Http\Controllers\ImageController;
use App\Http\Requests\SuperAdmin\SiteSetting\SiteSettingRequest;
use App\Models\Service\SuperAdmin\SiteSetting\SiteSettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;

class SiteSettingController extends Controller
{
    protected $siteSetting;
    protected $imageController;
    function __construct(SiteSettingService $siteSetting, ImageController $imageController)
    {
        $this->siteSetting=$siteSetting;
        $this->imageController=$imageController;
    }
    public function edit($id)
    {
        $siteSetting=$this->siteSetting->find($id);
        return view('super-admin.site-setting.index',compact('siteSetting'));
    }
    public function update(SiteSettingRequest $request, $id)
    {
        $siteSettingInfo=$request->all();
        $folder_name='Nav';
        $siteSetting=$this->siteSetting->find($id);
        $siteSettingInfo['map'] = $request->map;


        if($request->file('logo_image')==''){
            if($request->get('delete_logo_image')){
                $this->imageController->deleteImg($folder_name,$siteSetting->logo_image);
                $siteSettingInfo['logo_image'] = NULL;
            }else {
                $siteSettingInfo['logo_image'] = $siteSetting->logo_image;
            }
        }
        else{
            $this->imageController->deleteImg($folder_name,$siteSetting->logo_image);
            $ImgName=$this->imageController->saveAnyImg($request,$folder_name,'logo_image',755,146);
            $siteSettingInfo['logo_image']=$ImgName;
        }

        if($request->file('footer_logo_image')==''){
            if($request->get('delete_footer_logo_image')){
                $this->imageController->deleteImg($folder_name,$siteSetting->footer_logo_image);
                $siteSettingInfo['footer_logo_image'] = NULL;
            }else {
                $siteSettingInfo['footer_logo_image'] = $siteSetting->footer_logo_image;
            }
        }
        else{
            $this->imageController->deleteImg($folder_name,$siteSetting->footer_logo_image);
            $ImgName=$this->imageController->saveAnyImg($request,$folder_name,'footer_logo_image',755,146);
            $siteSettingInfo['footer_logo_image']=$ImgName;
        }

        if($this->siteSetting->update($id, $siteSettingInfo)){
        Alert::success('Success !!!', 'Setting Updated')->persistent('Close');
        // Toastr::success('Site Setting updated successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('site-setting.edit',1);
        }else{
        Alert::error('Oops !!!', 'Problem in updating setting')->persistent('Close');
            return redirect()->route('site-setting.edit',1);
        }
    }

    public function systemLog(){
        $data['file_logs'] = DB::table('activity_logs')->where('type', 'file')->orderBy('created_at', 'desc')->get();
        $data['review_logs'] = DB::table('activity_logs')->where('type', 'review')->orderBy('created_at', 'desc')->get();
        $data['staff_logs'] = DB::table('activity_logs')->where('type', 'staff')->orderBy('created_at', 'desc')->get();
        $data['client_logs'] = DB::table('activity_logs')->where('type', 'client')->orderBy('created_at', 'desc')->get();
        $data['logs'] = DB::table('activity_logs')->whereIn('type', ['login_logout', 'resetpw'])->orderBy('created_at', 'desc')->get();
        return view('super-admin.notification.log', $data);
    }
}
