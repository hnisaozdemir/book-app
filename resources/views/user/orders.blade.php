<!DOCTYPE html>
<html>
<head>
    <title>Siparişlerim</title>
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.png') }}" alt="Kullanıcı ikonu" class="seller-icon">
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
        </div>
        <div class="navbar-right">
            <a href="{{ route('user.dashboard') }}"><img src="{{ asset('images/main-page.png') }}" class="nav-icon">Anasayfa</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <h2>Siparişlerim</h2>

    @forelse ($orders as $order)
        <div class="order-card">
            <p><strong>Sipariş No:</strong> {{ $order->id }}</p>
            <p><strong>Tarih:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Toplam Tutar:</strong> {{ number_format($order->total_price, 2) }} ₺</p>

            <h4>Ürünler:</h4>
            <ul>
                @foreach ($order->items as $item)
                    <li>
                        {{ $item->product->name }} -
                        {{ $item->quantity }} adet -
                        {{ number_format($item->price, 2) }} ₺
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>Henüz bir siparişiniz yok.</p>
    @endforelse
</body>
</html>
