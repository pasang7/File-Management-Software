<?php
namespace App\Models\Service\SuperAdmin\ChatFile;
use App\Models\Model\SuperAdmin\ChatFile\ChatFile;


class ChatFileService
{
  protected $chatFile;

  function __construct(ChatFile $chatFile)
  {
      $this->chatFile = $chatFile;
  }

  public function create(array $data)
  {
      return  $chatFile = $this->chatFile->create($data);
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
           return  $chatFile = $this->chatFile->find($id);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function update($id,array $data)
    {
        try{
            $chatFile = $this->chatFile->find($id);
            return  $chatFile = $chatFile->update($data);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function delete($id)
    {
        try{
            $chatFile = $this->chatFile->find($id);
            return  $chatFile = $chatFile->delete();
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
        return $this->chatFile->orderBy('order','asc')->paginate($filter['limit']);
    }

    /**
     * Get all Product Categorys
     *
     * @return Collection
     */
    public function all()
    {
        return $this->chatFile->get();
    }
    public function updateStatus($ids,$status)
    {
        return $this->chatFile->whereIn('id',$ids)->update(array('status'=>$status));
    }
    public function deletePost($ids)
    {
        return $this->chatFile->whereIn('id',$ids)->delete();
    }
    public function search($key)
    {
        $filter['limit']=25;
        return $this->chatFile->where(function($query) use ($key) {
            $terms = explode('-', $key);
            foreach ($terms as $t) {
                $query->where('title', 'LIKE', '%' . $t . '%');
            }
        })->paginate($filter['limit']);
    }
 }