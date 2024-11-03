<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index' , [
            'title' => 'Login',
            'gambar' => 'logo.png'
            
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {  
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            
            return redirect()->intended('/admin/dashboard')->with('success','Login Berhasil');
        }

        return back()->with('loginError' , 'Login gagal !! silahkan masukan data dengan benar!');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
