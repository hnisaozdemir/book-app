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
        <img src="{{ asset('images/seller-icon.png') }}" alt="Kullanıcı ikonu" class="seller-icon">
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>

<h2>Adres Bilgisi</h2>

<form method="POST" action="{{ route('user.address.save') }}" style="max-width: 600px;">
    @csrf
    <div>
        <label for="address">Adresiniz:</label><br>
        <textarea id="address" name="address" rows="5" style="width:100%;" required>{{ old('address', $user->address) }}</textarea>
        @error('address')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" style="margin-top: 15px;">Kaydet ve Ödeme Sayfasına Geç</button>
</form>

<a href="{{ route('user.cart') }}" class="btn btn-view" style="margin-top: 20px; display: inline-block;">Sepete Geri Dön</a>

</body>
</html>
