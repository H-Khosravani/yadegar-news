<?php

namespace Mlk\Category\Http\Controllers;

use Mlk\Category\Http\Requests\CategoryRequest;
use Mlk\Category\Models\Category;
use Mlk\Category\Repositories\CategoryRepo;
use Mlk\Category\Services\CategoryService;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    public CategoryRepo $repo;
    
    public CategoryService $service;

    public function __construct(CategoryRepo $categoryRepo, CategoryService $categoryService)
    {
        $this->repo = $categoryRepo;

        $this->service = $categoryService;
    }

    public function index()
    {
        $categories = $this->repo->index()->paginate(10); 

        return view('Category::index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->repo->index()->get(); 

        return view('Category::create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->service->store($request);

        return to_route('categories.index')->with(['success_message' => 'دسته بندی با موفقیت ساخته شد']);
    }

    public function edit($id)
    {
        $category = $this->repo->findById($id); 

        $categories = $this->repo->index()->where('id', '!=', $category->id)->get();  

        return view('Category::edit', compact(['category', 'categories']));
    }

    public function update(CategoryRequest $request, $id)
    {
        $this->service->update($request, $id); 

        return to_route('categories.index')->with(['success_message' => 'دسته بندی با موفقیت ابدیت شد']);
    }

    public function destroy($id)
    {
        $this->repo->delete($id); 

        return to_route('categories.index')->with(['success_message' => 'دسته بندی با موفقیت حذف شد']);
    }

    public function changeStatus($id)
    {
        $category = $this->repo->findById($id);
        $this->repo->changeStatus($category);

        return back()->with(['success_message' => 'وضعیت دسته بندی با موفقیت تغییر کرد']);
    }
}