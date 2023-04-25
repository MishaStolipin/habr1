<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(15);
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
    public function show(string $id)
    {
        dd(__METHOD__);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();

        $item = BlogCategory::where()->where(function (){

        })->join();
        $item = $categoryRepository->getEdit();
        $categoryList = $categoryRepository->getForComboBox();


        return view('blog.admin.categories.edit', compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {

//        $rules =[
//            'title' =>'required|min:5|max:200',
//            'slug' =>'max:200',
//            'description' =>'string|max:500|min:3',
//            'parent_id' => 'required|integer|exists:blog_categories,id',
//        ];
//        $validatedData = $this->validate($request, $rules);
//
//        $validatedData = $request->validate($rules);

//        dd($validatedData);



        $item = BlogCategory::find($id);
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
