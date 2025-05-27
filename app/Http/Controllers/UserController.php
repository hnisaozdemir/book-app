<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;



class UserController extends Controller
{

public function dashboard()
{
    $products = Product::where('is_sold', 0)->get();  // Satışta olan kitaplar
    return view('user.dashboard', compact('products'));
}
public function profile()
{
    // Kullanıcı bilgilerini view'a yolla
    return view('user.profile');  // user/profile.blade.php dosyası olmalı
}
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    // Mevcut şifre doğru mu?
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Mevcut şifreniz hatalı.');
    }

    // Şifreyi güncelle
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Şifreniz başarıyla güncellendi.');
}
     // Kullanıcı kitap listesi
    public function products()
    {
        $products = Product::where('is_sold', 0)->get();  // Satışta olanları getir
        return view('user.products', compact('products'));
    }

public function showProduct($id)
{
    $product = Product::with('user')->findOrFail($id);
    return view('product.product_show', compact('product'));
}

public function showAddressForm()
{
    $user = Auth::user();
    return view('user.address', compact('user'));
}
public function saveAddress(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:1000',
    ]);

    $user = Auth::user();
    $user->address = $request->address;
    $user->save();

    return redirect()->route('user.checkout')->with('message', 'Adresiniz kaydedildi.');
}

public function myOrders()
{
    $user = Auth::user();

  
    $orders = $user->orders()
        ->with(['items.product'])
        ->orderBy('id', 'desc')
        ->get();

    return view('user.orders', compact('orders'));
}





}