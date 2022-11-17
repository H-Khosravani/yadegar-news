<?php

namespace Mlk\Home\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return view('Home::index');
    }
}
