<?php
/**
 * Created by PhpStorm.
 * User: Suresh
 * Date: 8/2/2018
 * Time: 11:12 AM
 */

namespace App\Models\Service\SuperAdmin\File;




use App\Models\Model\SuperAdmin\File\File;


class FileService
{
  protected $file;

  function __construct(File $file)
  {
      $this->file = $file;
  }

  public function create(array $data)
  {
      return  $file = $this->file->create($data);
      try{
      }
      catch (\Exception $e)
      {
          return false;
      }
  }

    public function find($id)
    {
        try{
           return  $file = $this->file->find($id);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function update($id,array $data)
    {
        try{
            $file = $this->file->find($id);
            return  $file = $file->update($data);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function delete($id)
    {
        try{
            $file = $this->file->find($id);
            return  $file = $file->delete();
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
        return $this->file->orderBy('order','asc')->paginate($filter['limit']);
    }

    /**
     * Get all Product Categorys
     *
     * @return Collection
     */
    public function all()
    {
        return $this->file->get();
    }
    public function updateStatus($ids,$status)
    {
        return $this->file->whereIn('id',$ids)->update(array('status'=>$status));
    }
    public function deletePost($ids)
    {
        return $this->file->whereIn('id',$ids)->delete();
    }
    public function filesByFolder($id)
    {
        $filter['limit'] = 100;
        return $this->file->whereFolderId($id)->paginate($filter['limit']);
    }
    public function search($key)
    {
        $filter['limit']=25;
        return $this->file->where(function($query) use ($key) {
            $terms = explode('-', $key);
            foreach ($terms as $t) {
                $query->where('title', 'LIKE', '%' . $t . '%');
            }
        })->paginate($filter['limit']);
    }
 }