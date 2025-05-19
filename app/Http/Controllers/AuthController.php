<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Giriş formunu göster
    public function showLoginForm()
    {
        return view('login');
    }

    // Giriş işlemini gerçekleştir
    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember'); // checkbox işaretli mi kontrol et

    if (Auth::attempt($credentials, $remember)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Admin sayfasına hoş geldiniz!');
        } else {
            return redirect()->route('user.dashboard')->with('success', 'Kullanıcı sayfasına hoş geldiniz!');
        }
    }

    return back()->withErrors(['email' => 'Geçersiz giriş bilgileri'])->withInput();
    }

    // Kayıt formunu göster
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Kayıt işlemini gerçekleştir
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Varsayılan rol
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Kayıt başarılı. Hoş geldiniz!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Çıkış yapıldı.');
    }
}
