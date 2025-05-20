<!DOCTYPE html>
<html>
<head>
    <title>Satın Alma</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>
@if (session('message'))
    <div style="background-color: #f8d7da; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; color: #721c24;">
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

<h2>Satın Alma Bilgileri</h2>

<form action="{{ route('user.purchase.confirm') }}" method="POST" style="max-width: 400px;">
    @csrf
    <div>
        <label for="card_number">Kart Numarası</label><br>
        <input type="text" id="card_number" name="card_number" maxlength="16" required value="{{ old('card_number') }}">
        @error('card_number')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="expiry_date">Son Kullanma Tarihi (MM/YY)</label><br>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required value="{{ old('expiry_date') }}">
        @error('expiry_date')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="cvv">CVV</label><br>
        <input type="text" id="cvv" name="cvv" maxlength="3" required value="{{ old('cvv') }}">
        @error('cvv')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" style="margin-top: 15px;">Siparişi Onayla</button>
</form>

<a href="{{ route('user.cart') }}" class="btn btn-view" style="margin-top: 20px; display: inline-block;">Geri Dön</a>

</body>
</html>
