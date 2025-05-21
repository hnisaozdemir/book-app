<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

public function dashboard()
{
    $products = Product::where('is_sold', 0)->get();  // Satışta olan kitaplar
    return view('user.dashboard', compact('products'));
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



}
