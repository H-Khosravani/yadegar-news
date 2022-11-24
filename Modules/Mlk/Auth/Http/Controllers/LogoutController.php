<?php

namespace Mlk\Auth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;


class LogoutController extends BaseController
{
    public function __invoke(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return to_route('home.index');
    }
}
