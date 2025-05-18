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
        return view('auth.login'); // login.blade.php dosyasını gösterecek
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
            Auth::login($user); // Oturum başlat

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
