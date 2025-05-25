<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Profil</title>
    <link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
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
            <a href="{{ route('user.orders') }}"><img src="{{ asset('images/orders.png') }}" class="nav-icon">Siparişlerim</a>
            <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <div class="container">
        <h1>Profil Bilgileriniz</h1>

        <div class="info-box">
            <p><strong>Adı:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Hesap Oluşturulma Tarihi:</strong> {{ Auth::user()->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <h2>Şifre Güncelle</h2>

        @if (session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('user.updatePassword') }}" method="POST">

            @csrf
            <label>Mevcut Şifre:</label><br>
            <input type="password" name="current_password" required><br><br>

            <label>Yeni Şifre:</label><br>
            <input type="password" name="new_password" required><br><br>

            <label>Yeni Şifre Tekrar:</label><br>
            <input type="password" name="new_password_confirmation" required><br><br>

            <button type="submit">Şifreyi Güncelle</button>
        </form>
    </div>
</body>
</html>