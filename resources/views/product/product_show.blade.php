<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Detaylar</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.png') }}" alt="Kullanıcı ikonu" class="seller-icon">
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
        </div>
        <div class="navbar-right">
            <a href="{{ route('user.dashboard') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon"> Geri</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon"> Çıkış Yap</a>
        </div>
    </nav>

    <div class="product-detail-container">
        <h2>{{ $product->name }}</h2>
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        <p><strong>Açıklama:</strong> {{ $product->description ?? 'Açıklama bulunmamaktadır.' }}</p>
        <p><strong>Satıcı:</strong> {{ $product->user->name ?? 'Bilinmiyor' }}</p>
        <p><strong>Fiyat:</strong> {{ number_format($product->price, 2) }} ₺</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 15px;">Geri Dön</a>
    </div>

</body>
</html>
