<?php
namespace App\Models\Service\SuperAdmin\Chatroom;
use App\Models\Model\SuperAdmin\Chatroom\Chatroom;


class ChatroomService
{
  protected $chatroom;

  function __construct(Chatroom $chatroom)
  {
      $this->chatroom = $chatroom;
  }

  public function create(array $data)
  {
      return  $chatroom = $this->chatroom->create($data);
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
           return  $chatroom = $this->chatroom->find($id);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function update($id,array $data)
    {
        try{
            $chatroom = $this->chatroom->find($id);
            return  $chatroom = $chatroom->update($data);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function delete($id)
    {
        try{
            $chatroom = $this->chatroom->find($id);
            return  $chatroom = $chatroom->delete();
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
        return $this->chatroom->orderBy('order','asc')->paginate($filter['limit']);
    }

    /**
     * Get all Product Categorys
     *
     * @return Collection
     */
    public function all()
    {
        return $this->chatroom->get();
    }
    public function updateStatus($ids,$status)
    {
        return $this->chatroom->whereIn('id',$ids)->update(array('status'=>$status));
    }
    public function deletePost($ids)
    {
        return $this->chatroom->whereIn('id',$ids)->delete();
    }
    public function search($key)
    {
        $filter['limit']=25;
        return $this->chatroom->where(function($query) use ($key) {
            $terms = explode('-', $key);
            foreach ($terms as $t) {
                $query->where('title', 'LIKE', '%' . $t . '%');
            }
        })->paginate($filter['limit']);
    }
 }