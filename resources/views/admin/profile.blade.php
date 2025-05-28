<!DOCTYPE html>
<html>
<head>
    <title>Admin Profil</title>
    <link rel="stylesheet" href="{{ asset('css/adminprofile.css') }}">
</head>
<body>
    <nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">Tüm Kitaplar</a>
        <a href="{{ route('admin.availableBooks') }}">Satıştaki Kitaplar</a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
        <a href="{{ route('admin.orders') }}">Siparişler</a>
       <a href="/admin/earnings">
            <img src="{{ asset('images/coins.png') }}" class="nav-icon">Kazanç
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
    <div class="container">
    <h1>Profil Bilgileriniz</h1>

    <div class="info-box">
        <p><strong>Adı:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Hesap Oluşturulma Tarihi:</strong> {{ Auth::user()->created_at->format('d.m.Y H:i') }}</p>
    </div>

    <h2>Şifre Güncelle</h2>

    @if (session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-message validation-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.updatePassword') }}" method="POST">
        @csrf
        <label for="current_password">Mevcut Şifre</label>
        <input type="password" name="current_password" id="current_password" required>

        <label for="new_password">Yeni Şifre</label>
        <input type="password" name="new_password" id="new_password" required>

        <label for="new_password_confirmation">Yeni Şifre Tekrar</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>

        <button type="submit">Şifreyi Güncelle</button>
    </form>
</div>
</body>
</html>