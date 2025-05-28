<!DOCTYPE html>
<html>
<head>
    <title>Adres Bilgisi</title>
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
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    </div>
    </div>
    <div class="navbar-right">
        <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
                <a href="{{ route('user.profile') }}">
            <img src="{{ asset('images/seller-icon.png') }}" class="nav-icon" alt="Profil">
            <span>Profilim</span>
        </a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>


<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
   style="font-size: 16px; display: flex; align-items: center; text-decoration: none; cursor: pointer;">
    <img src="{{ asset('images/user-logout.png') }}" class="nav-icon" alt="Çıkış Yap İkonu">
    <span style="margin-left: 5px;">Çıkış Yap</span>
</a>
    </div>
</nav>

<h2 class="form-title">Adres Bilgileri</h2>


<div class="form-container">
    <form method="POST" action="{{ route('user.address.save') }}">
        @csrf
        <div>
            <label for="address">Adresiniz:</label>
            <textarea id="address" name="address" rows="5" required>{{ old('address', $user->address) }}</textarea>
            @error('address')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="btn-container">
            <a href="{{ route('user.cart') }}" class="btn btn-view">Sepete Geri Dön</a>
            <button type="submit" class="btn btn-primary">Adresi Kaydet</button>
            <a href="{{ route('user.checkout') }}" class="btn btn-secondary">Ödeme Sayfasına Geç</a>
        </div>
    </form>
</div>
</div>



</body>
</html>