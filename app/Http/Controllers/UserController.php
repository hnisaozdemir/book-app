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

public function showProduct($id)
{
    $product = Product::with('user')->findOrFail($id);
    return view('product.product_show', compact('product'));
}


    // Sepete ekleme işlemi
public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        return redirect()->route('user.cart')->with('message', 'Bu ürün zaten sepete eklenmiş.');
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('user.cart')->with('message', "{$product->name} sepete eklendi.");
}

    public function cart()
{
    $cart = session()->get('cart', []);
    return view('user.cart', compact('cart'));
}

}
