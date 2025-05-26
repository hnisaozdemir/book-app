<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}?v={{ time() }}">
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
        <a href="{{ route('user.orders') }}"><img src="{{ asset('images/orders.png') }}" class="nav-icon" alt="Siparişlerim İkonu">Siparişlerim</a>
        <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon" alt="Sepet İkonu">Sepet</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon" alt="Çıkış Yap İkonu">Çıkış Yap</a>
    </div>
</nav>

<h2>Satışta Olan Kitaplar</h2>

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


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</body>
</html>
