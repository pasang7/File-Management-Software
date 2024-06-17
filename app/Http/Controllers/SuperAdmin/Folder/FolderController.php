<?php

namespace App\Http\Controllers\SuperAdmin\Folder;
use App\Http\Requests\SuperAdmin\Folder\FolderRequest;
use App\Models\Service\SuperAdmin\Folder\FolderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\DbHelper as DbHelper;
use App\Models\Model\SuperAdmin\Folder\Folder;
use App\Models\Model\SuperAdmin\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $folder;
    function __construct(FolderService $folder)
    {
        $this->folder=$folder;
    }
    public function index()
    {
        $folders=$this->folder->paginate();
        $parents=$this->folder->all();
        return view('super-admin.folder.index',compact('folders','parents'));
    }
    public function parent($id)
    {
        $data['folders']=$this->folder->parentPaginate($id);
        $data['parents']=$this->folder->all();
        $data['show_search']='yes';
        return view('super-admin.folder.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['clients'] = User::where('role', 'others')->where('status', 'active')->get();
        return view('super-admin.folder.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolderRequest $request)
    {
        $clients = $request->client_id;
        if(!empty($clients)){
            foreach($clients as $client){
                $clientName = User::where('id', $client)->first()->name;
                $folderInfo=$request->all();
                $folderInfo['title']=$request->show_title .' ('. $clientName .')';
                $folderInfo['show_title']=$request->show_title;
                $folderInfo['client_id']=$client;
                $folderInfo['order']=DbHelper::nextSortOrder('folders');
                $this->folder->create($folderInfo);
                DB::table('activity_logs')->insert([
                    'message' => Auth::user()->name. ' created new folder of client ' .$clientName,
                    'type' => 'file',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            Alert::success('Success !!!', 'Folder created successfully')->persistent('Close');
            return redirect()->route('folder.index');
        }
        Alert::error('Oops !!!', 'Folder should have at least one client')->persistent('Close');
            return redirect()->route('folder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $folder=$this->folder->find($id);
        $data['clients'] = User::where('role', 'others')->where('status', 'active')->get();
        return view('super-admin.folder.edit',$data,compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FolderRequest $request, $id)
    {
        $folderInfo=$request->all();
        $folder=$this->folder->find($id);
        $folderInfo['title']=$request->show_title .' ('. $folder->client->name .')';
        $folderInfo['show_title']=$request->show_title;
        if($this->folder->update($id, $folderInfo)){
            Alert::success('Success !!!', 'Folder updated successfully')->persistent('Close');
            return redirect()->route('folder.index');
        }else{
            Alert::error('Oops !!!', 'Problem in updating folder')->persistent('Close');
            return redirect()->route('folder.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder=$this->folder->find($id);
        if($this->folder->delete($id)){
            Alert::success('Success !!!', 'Folder deleted successfully')->persistent('Close');
            return redirect()->route('folder.index');
        }else{
            Alert::error('Oops !!!', 'Problem in deleting folder')->persistent('Close');
            return redirect()->route('folder.index');
        }
    }
    public function search()
    {
        $folders=$this->folder->search(str_slug($_GET['key']));
        $parents=$this->folder->all();
        $show_search='yes';
        return view('super-admin.folder.index',compact('folders','parents','show_search'));
    }
    public function foldersByClient($id)
    {
        $data['client']=$client= User::where('id', $id)->firstOrFail();
        $data['folders']=Folder::where('parent_id',0)->where('client_id',$client->id)->orderBy('order','asc')->get();
        return view('super-admin.file.folder-by-client',$data);
    }
}
