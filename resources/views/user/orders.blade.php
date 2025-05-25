<!DOCTYPE html>
<html>
<head>
    <title>Siparişlerim</title>
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
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
            <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <h2>Siparişlerim</h2>

    @forelse ($orders as $order)
        <div class="order-card">
            <p><strong>Sipariş No:</strong> {{ $order->id }}</p>
            <p><strong>Tarih:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Toplam Tutar:</strong> {{ number_format($order->total_price, 2) }} ₺</p>
            @php
                $state = $order->items->first()->state ?? 1;
                $stateText = match($state) {
                    1 => 'Sipariş Alındı',
                    2 => 'Sipariş Hazırlanıyor',
                    3 => 'Kargoya Verildi',
                    default => 'Bilinmeyen Durum'
                };
                $stateImage = match($state) {
        1 => 'images/ordertaken.png',
        2 => 'images/processing.png',
        3 => 'images/cargo.png',
        default => 'images/bilinmeyen.png'
    }; 
            @endphp

            <p><strong>Sipariş Durumu:</strong> {{ $stateText }}</p>
             <img src="{{ asset($stateImage) }}" alt="{{ $stateText }}" style="width: 60px; height: auto; margin-top: 5px;">
</p>

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