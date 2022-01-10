<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->withInput($request->only('email', 'remember'))
                ->with('status', 'Invalid login details');
        }

        if (auth()->user()->is_admin) {
            return redirect('/admin');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
