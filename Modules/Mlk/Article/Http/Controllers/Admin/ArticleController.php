<?php

namespace Mlk\Article\Http\Controllers\Admin;

use Mlk\Article\Http\Requests\ArticleRequest;
use Mlk\Article\Models\Article;
use Mlk\Article\Repositories\ArticleRepo;
use Mlk\Article\Services\ArticleService;
use Mlk\Category\Repositories\CategoryRepo;
use App\Http\Controllers\Controller;
use Mlk\Share\Repositories\ShareRepo;
use Mlk\Share\Services\ShareService;



class ArticleController extends Controller
{
    private string $class = Article::class; 

    public ArticleRepo $repo;
    public ArticleService $service;

    public function __construct(ArticleRepo $articleRepo, ArticleService $articleService)
    {
        $this->repo = $articleRepo;
        $this->service = $articleService;
    }

    public function index()
    {
        $this->authorize('manage', $this->class);
        $articles = $this->repo->index()->paginate(10);

        return view('Article::Admin.index', compact('articles'));
    }

    public function create(CategoryRepo $categoryRepo)
    {
        $this->authorize('manage', $this->class);

        $categories = $categoryRepo->getActiveCategories()->get(); # Relation With categories Table

        return view('Article::Admin.create', compact('categories'));
    }

    public function store(ArticleRequest $request)
    {
        $this->authorize('manage', $this->class);

        // [$imageName, $imagePath] = ShareService::uploadImage($request->file('image'), 'articles');   1
        [$imageName, $imagePath] = $this->service->uploadImage2($request->file('image'), 'articles');

        $this->service->store($request, auth()->id(), $imageName, $imagePath); # INSERT Path And Name File In articles Table

        # alert()->success(, 'عملیات با موفقیت انجام شد');
        // ShareRepo::successMessage('ساخت مقاله'); 2
        return to_route('articles.index');
    }

    public function edit($id, CategoryRepo $categoryRepo)
    {
        $this->authorize('manage', $this->class);
        $article = $this->repo->findById($id);
        $categories = $categoryRepo->getActiveCategories()->get();

        return view('Article::Admin.edit', compact(['article', 'categories']));
    }

    public function update(ArticleRequest $request, $id)
    {
        $this->authorize('manage', $this->class);

        $file = $request->file('image');

        $article = $this->repo->findById($id);

        [$imageName, $imagePath] = $this->uploadImage($file, $article);

        $this->service->update($request, $id, $imageName, $imagePath);

        // ShareRepo::successMessage('ویرایش مقاله'); 3
        return to_route('articles.index');
    }

    public function destroy($id)
    {
        $this->authorize('manage', $this->class);

        $article = $this->repo->findById($id);
        $this->service->deleteImage($article,'articles'); # Delete Image File From ROOT>Public>Storage>images>articles>IMAGEFile
        $this->repo->delete($id);

        // ShareRepo::successMessage('حذف مقاله'); 4
        return to_route('articles.index');
    }

    # Change Status Btn Route In index.blade.php
    public function changeStatus($id)
    {
        $article = $this->repo->findById($id);
        $this->service->changeStatus($article);

        // ShareRepo::successMessage('تغییر وضعیت مقاله'); 5
        return to_route('articles.index');
    }

    # Private Method
        private function uploadImage($file, $article): array
        {
        if (!is_null($file)) {
            // [$imageName, $imagePath] = ShareService::uploadImage($file, 'articles'); 6
            [$imageName, $imagePath] = $this->service->uploadImage2($file,'articles');

        }
        else {
            $imageName = $article->imageName;
            $imagePath = $article->imagePath;
        }

        return array($imageName, $imagePath);
    }
}
