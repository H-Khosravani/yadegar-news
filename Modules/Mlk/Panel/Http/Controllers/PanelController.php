<?php

namespace Mlk\Panel\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PanelController extends BaseController
{
    public function index()
    {
        return view('Panel::index');
    }
}
