<?php
namespace App\Repository;


use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogCategoryRepository extends CoreRepository
{


    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->starConditions()->find($id);
    }

    public function getForComboBox()
    {
//        return $this->starConditions()->all();

        $columns = implode(', ',[
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

//        $result[]=$this
//            ->starConditions()
//            ->all();
//        $result[] = $this
//            ->starConditions()
//            ->select('blog_categories.*',
//                \DB::raw('CONCAT (id, ". ", title) AS id_title'))
//            ->toBase()
//            ->get();

        $result= $this
            ->starConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();


//        dd($result->first);
        return $result;
    }

    /**
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */


    public function getAllWhithPaginate($perPage =null)
    {
        $columns = ['id','title','parent_id'];

        $result = $this
            ->starConditions()
            ->select($columns)
            ->paginate($perPage);
//dd($result);
        return $result;
    }
}
