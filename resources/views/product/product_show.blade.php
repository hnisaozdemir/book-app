<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Detaylar</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
           <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        </div>
        <div class="navbar-right">
             @guest
        <a href="{{ route('login') }}">Giriş Yap</a>
    @endguest
            @auth
            <a href="{{ route('user.cart') }}"><img src="{{ asset('images/cart.png') }}" class="nav-icon">Sepet</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
   style="font-size: 16px; display: flex; align-items: center; text-decoration: none; cursor: pointer;">
    <img src="{{ asset('images/logout.png') }}" class="nav-icon" alt="Çıkış Yap İkonu">
    <span style="margin-left: 5px;">Çıkış Yap</span>
    @endAuth
</a>
        </div>
    </nav>

    <div class="product-detail-container">
        <h2>{{ $product->name }}</h2>
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">

        <p><strong>Açıklama:</strong> {{ $product->description ?? 'Açıklama bulunmamaktadır.' }}</p>
        <p><strong>Yazar:</strong> {{ $product->author ?? 'Belirtilmemiş' }}</p>
        <p><strong>Tür:</strong> {{ $product->type ?? 'Belirtilmemiş' }}</p>
        <p><strong>Basım Yılı:</strong> {{ $product->publication_year ?? 'Belirtilmemiş' }}</p>
        <p><strong>Sayfa Sayısı:</strong> {{ $product->page_count ?? 'Belirtilmemiş' }}</p>
         <p><strong>Fiyat:</strong> {{ number_format($product->price, 2) }} ₺</p>

        <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 15px;">Geri Dön</a>
    </div>

</body>
</html>
