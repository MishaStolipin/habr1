<?php
namespace App\Repository;


use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{


    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->starConditions()->find($id);
    }

    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this
            ->starConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            ->paginate(25);
//dd($result);
        return $result;
    }
}
