<?php
namespace Mlk\Auth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Mlk\Auth\Http\Requests\LoginRequest;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function view()
    {
        return view('Auth::login');
    }
    public function login(LoginRequest $request /*Validate*/)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
            return to_route('home.index');
        }
        return redirect()->back()->withErrors(['data_problem' => 'اطلاعات درست نبوده!']); 
    }
}
