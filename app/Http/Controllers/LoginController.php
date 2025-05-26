<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
{
    if (Auth::check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return view('auth.login');
}

    protected function redirectTo()
{
    if (auth()->user()->role === 'admin') {
        return '/admin/dashboard';
    }
    return '/'; // diğer rollerin yönlendirmesi
}

    public function login(Request $request)
    {
        // Doğrulama
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kullanıcıyı veritabanından çek
        $user = User::where('email', $request->email)->first();

        // Kullanıcı varsa ve şifre doğruysa
        if ($user && Hash::check($request->password, $user->password)) {
           $remember = $request->has('remember');
        Auth::login($user, $remember);


            // Rol kontrolü
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // admin paneli
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard'); // kullanıcı paneli
            } else {
                return redirect()->route('home'); // varsayılan sayfa
            }
        }

        // Hatalı giriş
        return back()->withErrors(['email' => 'Geçersiz bilgiler'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}