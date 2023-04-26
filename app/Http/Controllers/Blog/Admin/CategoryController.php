<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repository\BlogCategoryRepository;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;


    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $paginator = BlogCategory::paginate(15);

        $paginator = $this->blogCategoryRepository->getAllWhithPaginate();


//        dd($paginator);

        return view ('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();
        //TODO вставить в блейд
//        $categoryList = BlogCategory::pluck('title','id');

        return view('blog.admin.categories.edit',
            compact('item','categoryList'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryUpdateRequest $request)
    {

        $data = $request -> input();
        if (empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);

        }

//        $item = new BlogCategory($data);
//
//        $item->save();

        $item = (new BlogCategory())->create($data);

        if ($item){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success'=>'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg'=>'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        dd(__METHOD__);
//
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();

//        $item = BlogCategory::where()->where(function (){
//        })->join();
        $item = $categoryRepository
            ->getEdit($id);
        $categoryList = $categoryRepository
            ->getForComboBox();


        return view('blog.admin.categories.edit', compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request -> all();

        $result = $item ->fill($data)->save();

        if ($result){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success'=>'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg'=>'Ошибка сохранения'])
                ->withInput();
        }

    }

}
