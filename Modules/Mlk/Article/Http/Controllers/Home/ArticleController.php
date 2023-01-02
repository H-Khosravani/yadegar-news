<?php

namespace Mlk\Article\Http\Controllers\Home;

use Mlk\Advertising\Models\Advertising;
use Mlk\Advertising\Repositories\AdvertisingRepo;
use Mlk\Article\Repositories\ArticleRepo;
use Mlk\Comment\Repositories\CommentRepo;
use Mlk\Home\Repositories\HomeRepo;
// use Mlk\Share\Http\Controllers\Controller;
use App\Http\Controllers\Controller;


class ArticleController extends Controller
{
    public ArticleRepo $repo;

    public function __construct(ArticleRepo $articleRepo)
    {
        $this->repo = $articleRepo;
    }

    public function home(CommentRepo $commentRepo) # Home.php
    {
        $articles = $this->repo->home()->paginate(6); # Catch Articles And Show Home.php
        $viewsArticles = $this->repo->getArticlesByViews()->latest()->limit(5)->get(); # Catch More Show Articles And Show In Home.php
        $latestComments = $commentRepo->getLatestComments()->limit(3)->get(); # Catch Comments And Show Home.php

        return view('Article::Home.home', compact(['articles', 'viewsArticles', 'latestComments']));
    }

    public function details($slug, HomeRepo $homeRepo, CommentRepo $commentRepo) # Single.php For Articles (Home.php - Category.php => Same Single Page)
    {
        $article = $this->repo->findBySlug($slug);

        if (is_null($article)) abort(404); # Show 404 If Not Exist URL Slug Single page



        $relatedArticles = $this->repo->relatedArticles($article->category_id, $article->id)->limit(3)->get();
        $latestComments = $commentRepo->getLatestComments()->limit(3)->get();

        return view('Article::Home.details', compact([
            'article', 'relatedArticles', 'homeRepo', 'latestComments',
        ]));
    }


}
