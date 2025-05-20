<!DOCTYPE html>
<html>
<head>
    <title>Sepetim</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>

@if (session('message'))
    <div style="background-color: #d4edda; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; color: #155724;">
        {{ session('message') }}
    </div>
@endif

<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/seller-icon.png') }}" alt="Kullanıcı ikonu" class="seller-icon">
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>

<div class="cart-container">
    <h2 class="cart-title">Sepetiniz</h2>

    @if($cartItems->count() == 0)
        <p class="empty-cart">Sepetinizde ürün yok.</p>
    @else
        @foreach($cartItems as $item)
            <div class="cart-item">
                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/100x120' }}" alt="Ürün Resmi">
                <div class="cart-item-info">
                    <h4>{{ $item->product->name }}</h4>
                    <div class="cart-item-price">{{ number_format($item->product->price, 2) }} ₺</div>
                    <div class="cart-item-quantity">Adet: {{ $item->quantity }}</div>
                </div>

                <form action="{{ route('user.cart.remove', $item->product->id) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Sil</button>
                </form>
            </div>
        @endforeach

        <a href="{{ route('user.checkout') }}" class="btn btn-primary" style="margin-top: 20px;">Sepeti Onayla</a>
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 15px;">Geri Dön</a>
</div>

</body>
</html>
