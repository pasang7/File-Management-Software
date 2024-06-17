<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ImageController;
use App\Models\Service\SuperAdmin\Menu\NavService;
use App\Models\Service\SuperAdmin\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionApiController extends Controller
{
    protected $imageController;
    protected $user;
    protected $nav;

    function __construct(ImageController $imageController, UserService $user, NavService $nav)
    {
        $this->user=$user;
        $this->imageController=$imageController;
        $this->nav=$nav;
    }
    public function updateStatus(Request $request)
    {
        $name=$request->get('name');
        if($request->get('status')=='1'){
            return $this->$name->updateStatus($request->get('id'),$request->get('status'));
        }
        if($request->get('status')=='0'){
            return $this->$name->updateStatus($request->get('id'),$request->get('status'));
        }
    }
    public function deletePost(Request $request)
    {
        $name=$request->get('name');
        foreach ($request->get('id') as $id){
            $info=$this->$name->find($id);
            $this->imageController->deleteImg(ucfirst($request->get('name')),$info->image);
        }
        return $this->$name->deletePost($request->get('id'));
    }
}
