<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kazançlar</title>
    <link rel="stylesheet" href="{{ asset('css/earnings.css') }}"> 
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/seller-icon.png') }}" alt="Satıcı İkonu" class="seller-icon">
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">Tüm Kitaplar</a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
        <a href="{{ route('logout') }}">
            <img src="{{ asset('images/user-logout.png') }}" alt="Çıkış Yap" class="nav-icon">Çıkış Yap
        </a>
    </div>
</nav>

<div class="content">
    <h2>Satılan Kitapların Kazancı</h2>

    @if($soldProducts->isEmpty())
        <p>Satılan kitap bulunmamaktadır.</p>
    @else
        <ul>
@foreach($soldProducts as $book)
    <li>
        Kitap Adı: {{ $book->name }} — Fiyat: {{ number_format($book->price, 2, ',', '.') }} ₺
    </li>
@endforeach
</ul>

<p>Toplam Kazanç: {{ number_format($totalEarnings, 2, ',', '.') }} ₺</p>
    @endif
</div>

</body>
</html>