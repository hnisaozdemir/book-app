<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItems;

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

    $cartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $id)
                    ->with('product')
                    ->first();

    if ($cartItem) {
        $productName = $cartItem->product->name ?? 'Ürün';
        $cartItem->delete();

        return redirect()->route('user.cart')->with('message', "{$productName} sepetten silindi.");
    }

    return redirect()->route('user.cart')->with('message', 'Ürün bulunamadı.');
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
        'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
        'cvv' => 'required|digits:3',
    ]);

    $user = Auth::user();
    $cartItems = $user->cartItems()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('user.cart')->with('message', 'Sepetiniz boş.');
    }

    DB::beginTransaction();

    try {
        // Toplam fiyat hesapla
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Siparişi kaydet
$order = Order::create([
    'user_id' => $user->id,
    'total_price' => $totalPrice,
    'created_at' => now(),
]);


        // Sipariş ürünlerini kaydet
        foreach ($cartItems as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                
            ]);

            // Ürünü satıldı olarak işaretle
            $item->product->is_sold = 1;
            $item->product->save();
        }

        // Sepeti temizle
        $user->cartItems()->delete();

        DB::commit();

        return redirect()->route('user.orders')->with('success', 'Siparişiniz alındı, teşekkür ederiz!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('message', 'Ödeme sırasında bir hata oluştu: ' . $e->getMessage());
    }
}

}
