<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


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

    // Kitap detay sayfası
    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('user.product_show', compact('product'));
    }

    // Sepete ekleme işlemi
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "{$product->name} sepete eklendi.");
    }
}
