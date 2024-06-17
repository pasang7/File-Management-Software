<?php
namespace App\Models\Service\SuperAdmin\File;
use App\Models\Model\SuperAdmin\File\FileReview;


class FileReviewService
{
  protected $fileReview;

  function __construct(FileReview $fileReview)
  {
      $this->fileReview = $fileReview;
  }

  public function create(array $data)
  {
      return  $fileReview = $this->fileReview->create($data);
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
           return  $fileReview = $this->fileReview->find($id);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function update($id,array $data)
    {
        try{
            $fileReview = $this->fileReview->find($id);
            return  $fileReview = $fileReview->update($data);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function delete($id)
    {
        try{
            $fileReview = $this->fileReview->find($id);
            return  $fileReview = $fileReview->delete();
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
        return $this->fileReview->orderBy('updated_at','desc')->paginate($filter['limit']);
    }

    /**
     * Get all Product Reviews
     *
     * @return Collection
     */
    public function all()
    {
        return $this->fileReview->get();
    }
    public function updateStatus($ids,$status)
    {
        return $this->fileReview->whereIn('id',$ids)->update(array('status'=>$status));
    }
    public function deletePost($ids)
    {
        return $this->fileReview->whereIn('id',$ids)->delete();
    }
    public function search($key)
    {
        $filter['limit']=25;
        return $this->fileReview->where(function($query) use ($key) {
            $terms = explode('-', $key);
            foreach ($terms as $t) {
                $query->where('title', 'LIKE', '%' . $t . '%');
            }
        })->paginate($filter['limit']);
    }
 }