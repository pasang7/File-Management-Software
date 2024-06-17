<?php
namespace App\Models\Service\SuperAdmin\Folder;
use App\Models\Model\SuperAdmin\Folder\Folder;

class FolderService
{
  protected $folder;

  function __construct(Folder $folder)
  {
      $this->folder = $folder;
  }

  public function create(array $data)
  {
      try{
         return  $folder = $this->folder->create($data);
      }
      catch (\Exception $e)
      {
         return false;
      }
  }

    public function find($id)
    {
        try{
           return  $folder = $this->folder->find($id);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function update($id,array $data)
    {
        try{
            $folder = $this->folder->find($id);
            return  $folder = $folder->update($data);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function delete($id)
    {
        try{
            $this->folder->where('parent_id',$id)->delete();
            $folder = $this->folder->find($id);
            return  $folder = $folder->delete();
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    /**
     * Paginate all Product PageList
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->folder->orderBy('order','asc')->where('parent_id',0)->paginate($filter['limit']);
    }
    public function parentPaginate($id){
        $filter['limit'] = 25;
        return $this->folder->orderBy('order','asc')->where('parent_id',$id)->paginate($filter['limit']);
    }
    /**
     * Get all Product Categorys
     *
     * @return Collection
     */
    public function all()
    {
        return $this->folder->all();
    }
    public function updateStatus($ids,$status)
    {
        return $this->folder->whereIn('id',$ids)->update(array('status'=>$status));
    }
    public function deletePost($ids)
    {
        return $this->folder->whereIn('id',$ids)->delete();
    }
    public function search($key)
    {
        $filter['limit']=25;
        return $this->folder->where(function($query) use ($key) {
            $terms = explode('-', $key);
            foreach ($terms as $t) {
                $query->where('title', 'LIKE', '%' . $t . '%');
            }
        })->paginate($filter['limit']);
    }
 }