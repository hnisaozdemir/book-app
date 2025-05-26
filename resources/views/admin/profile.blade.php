<!DOCTYPE html>
<html>
<head>
    <title>Admin Profil</title>
    <link rel="stylesheet" href="{{ asset('css/adminprofile.css') }}">
</head>
<body>
    <nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('admin.profile') }}">
    <img src="{{ asset('images/seller-icon.png') }}" alt="Admin" class="nav-icon"> 
</a>
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
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
            <p><strong>Adı:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Hesap Oluşturulma Tarihi:</strong> {{ $admin->created_at->format('d.m.Y H:i') }}</p>
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
        <form action="{{ route('admin.updatePassword') }}" method="POST">
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