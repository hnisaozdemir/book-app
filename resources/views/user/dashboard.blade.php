<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}?v={{ time() }}">
</head>
<body>
    
<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        <span class="welcome-text">Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>

    <div class="navbar-right">
        <a href="{{ route('user.orders') }}">
            <img src="{{ asset('images/orders.png') }}" class="nav-icon" alt="Siparişlerim">
            <span>Siparişlerim</span>
        </a>
        <a href="{{ route('user.cart') }}">
            <img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon" alt="Sepet">
            <span>Sepet</span>
        </a>
        <a href="{{ route('user.profile') }}">
            <img src="{{ asset('images/seller-icon.png') }}" class="nav-icon" alt="Profil">
            <span>Profilim</span>
        </a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('images/user-logout.png') }}" class="nav-icon" alt="Çıkış">
            <span>Çıkış Yap</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>

<h2>Satışta Olan Kitaplar</h2>

@if($products->isEmpty())
    <div style="background-color: #fff3cd; border-radius: 10px; padding: 15px 20px; display: flex; align-items: center; font-family: Arial, sans-serif; justify-content:center; width:100%; margin-bottom: 20px;">
        <span style="font-size: 24px; margin-right: 10px;">🔔</span>
        <span style="color: #856404;">Satışta hiç kitap bulunmamaktadır.</span>
    </div>
@else
    @foreach($products as $product)
        <div class="product-card">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <div class="product-info">
                <h3>{{ $product->name }}</h3>
                <p><strong>{{ number_format($product->price, 2) }} ₺</strong></p>
                <div class="btn-group">
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-add-to-cart" style="padding:10px 18px; font-size:16px; max-height:48px;">
                            <img src="{{ asset('images/shopping-bag.png') }}" alt="Sepete Ekle" style="width:22px; height:22px; object-fit: contain; vertical-align: middle; margin-right:8px;"> 
                            Sepete Ekle
                        </button>
                    </form>

                    <a href="{{ route('user.products.show', $product->id) }}" class="btn btn-view" style="padding:10px 18px; font-size:16px; max-height:48px; display: inline-flex; align-items: center; gap: 8px;">
                        <img src="{{ asset('images/overview.png') }}" alt="İncele" style="width:22px; height:22px; object-fit: contain; vertical-align: middle;"> 
                        İncele
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@endif

</body>
</html>
