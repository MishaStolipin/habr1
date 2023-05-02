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
            ->with(['category','user'])
//            ->with(['category'=>function ($query){$query->select(['id','title']);
//            },
////                'user:id,name',
//                ])
            ->paginate(25);
//dd($result);
        return $result;
    }
}
