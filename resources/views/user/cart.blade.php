<!DOCTYPE html>
<html>
<head>
    <title>Sepetim</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">

</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('user.profile') }}">
            <img src="{{ asset('images/seller-icon.png') }}" class="nav-icon" alt="Profil İkonu">
        </a>
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('user.dashboard') }}"><img src="{{ asset('images/main-page.png') }}" class="nav-icon">Anasayfa</a>
        <a href="{{ route('user.orders') }}"><img src="{{ asset('images/orders.png') }}" class="nav-icon" alt="Siparişlerim İkonu">Siparişlerim</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>

<div class="cart-container">
    <h2 class="cart-title">Sepetiniz</h2>

    @if (session('message'))
    <div class="session-message">
        {{ session('message') }}
    </div>
    @endif

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

        <a href="{{ route('user.address') }}" class="btn btn-confirm">Siparişi Onayla</a>
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 15px;">Geri Dön</a>
</div>



</body>
</html>
