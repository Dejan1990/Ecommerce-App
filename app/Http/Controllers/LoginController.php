<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'address' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'country' => ['string']
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country
        ]);

        auth()->login($user);
        //auth()->attempt($request->only('email', 'password'));

        return redirect('/');
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
        auth()->logout(); // auth()->user()->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
