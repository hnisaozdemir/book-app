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




}
