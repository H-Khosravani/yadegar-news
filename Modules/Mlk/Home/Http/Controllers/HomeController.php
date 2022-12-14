<?php

namespace Mlk\Home\Http\Controllers;



use Mlk\Article\Models\Article;
use Mlk\Home\Repositories\HomeRepo;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function index(HomeRepo $homeRepo)
    {
        return view('Home::index', compact(['homeRepo']));
    }
}
