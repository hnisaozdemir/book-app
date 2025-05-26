<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }
    public function showProfile()
{
    $admin = auth()->user(); // Giriş yapan admin
    return view('admin.profile', compact('admin'));
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $admin = auth()->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->with('error', 'Mevcut şifre yanlış.');
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    return back()->with('success', 'Şifreniz başarıyla güncellendi.');
}

    public function store(Request $request)
    {
        $imagePath = 'images/default-book.png'; // Varsayılan görsel

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'is_sold' => 0,
             'admin_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Kitap başarıyla eklendi.');
    }
    public function destroy($id)
{
    $product = Product::findOrFail($id);
    
    if ($product->image !== 'images/default-book.png' && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    $product->delete();

    return redirect()->back()->with('success', 'Kitap silindi.');
}
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');

    // Yeni görsel yüklendiyse işle
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public'); // public/images klasörüne yükler
        $product->image = 'storage/' . $imagePath;
    }

    $product->save();

    return redirect()->route('admin.dashboard')->with('success', 'Kitap başarıyla güncellendi.');
}
public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.edit', compact('product'));
}
// Satıştaki kitapları göster (is_sold = 0)
    public function showAvailableBooks()
    {
        $products = Product::where('is_sold', 0)->get();
        return view('admin.available_books', compact('products'));
    }

    // Satılan kitapları göster (is_sold = 1)
    public function showSoldBooks()
    {
        $products = Product::where('is_sold', 1)->get();
        return view('admin.sold_books', compact('products'));
    }
public function earnings()
{
    $soldProducts = Product::where('is_sold', 1)->get();
    $totalEarnings = $soldProducts->sum('price');
    return view('admin.earnings', compact('soldProducts', 'totalEarnings'));
}
public function showAddBookForm()
{
    return view('admin.add_book'); // Blade dosyanın yolu: resources/views/admin/add_book.blade.php
}


}