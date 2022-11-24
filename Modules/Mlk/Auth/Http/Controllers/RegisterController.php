<?php

namespace Mlk\Auth\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Mlk\Auth\Services\RegisterService;
use Mlk\Auth\Http\Requests\RegisterRequest;
use Illuminate\Routing\Controller as BaseController;

class RegisterController extends BaseController
{
    public function view()
    {
        return view('Auth::register');
    }

    public function register(RegisterRequest $request, RegisterService $registerService)
    
    {
        $user = $registerService->generateUser($request);

        auth()->loginUsingId($user->id);

        event(new Registered($user));

        return redirect()->route('home.index');
    }
}

