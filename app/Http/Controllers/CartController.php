<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Sepete ürün ekle
    public function addToCart(Request $request, $id)
    {
        $userId = Auth::id();
        $product = Product::findOrFail($id);

        // Sepette bu ürün var mı?
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            return redirect()->route('user.cart')->with('message', 'Bu ürün zaten sepete eklenmiş.');
        }

        // Yoksa ekle
        Cart::create([
            'user_id' => $userId,
            'product_id' => $id,
            'quantity' => 1,
            'added_at' => Carbon::now(),
        ]);

        return redirect()->route('user.cart')->with('message', "{$product->name} sepete eklendi.");
    }

    // Sepeti göster
    public function cart()
    {
        $userId = Auth::id();

        // Kullanıcının sepetteki ürünleri, ilişkili ürün bilgileri ile çek
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('user.cart', compact('cartItems'));
    }

    // Sepetten ürün sil
    public function removeFromCart($id)
    {
        $userId = Auth::id();

        Cart::where('user_id', $userId)
            ->where('product_id', $id)
            ->delete();

        return redirect()->route('user.cart')->with('message', 'Ürün sepetten silindi.');
    }

    // Checkout sayfası
    public function checkout()
    {
        $userId = Auth::id();

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('message', 'Sepetiniz boş. Satın alma işlemi için ürün ekleyiniz.');
        }

        return view('user.checkout', compact('cartItems'));
    }

    // Satın alma işlemi onayı
public function confirmPurchase(Request $request)
{
    $request->validate([
        'card_number' => 'required|digits:16',
        'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'], // MM/YY
        'cvv' => 'required|digits:3',
    ]);

    $user = Auth::user();

    $cartItems = $user->cartItems()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('user.cart')->with('message', 'Sepetiniz boş.');
    }

    DB::beginTransaction();
    try {
        // Burada gerçek ödeme entegrasyonu yapılabilir (şimdilik simülasyon)

        foreach ($cartItems as $item) {
            if ($item->product) {
                $item->product->is_sold = 1;
                $item->product->save();
            }
        }

        // Sepeti temizle
        $user->cartItems()->delete();

        DB::commit();

        return redirect()->route('user.dashboard')->with('message', 'Ödeme başarılı, teşekkürler!');


    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('message', 'Ödeme sırasında bir hata oluştu: ' . $e->getMessage());
    }
}

}
