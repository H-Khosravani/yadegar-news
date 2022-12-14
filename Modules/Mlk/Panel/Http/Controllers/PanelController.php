<?php

namespace Mlk\Panel\Http\Controllers;

use Mlk\Panel\Models\Panel;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {
        $this->authorize('index', Panel::class);

        return view('Panel::index');
    }
}
