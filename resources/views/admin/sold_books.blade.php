<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satılan Kitaplar</title>
    <link rel="stylesheet" href="{{ asset('css/sold_books.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('admin.profile') }}">
            <img src="{{ asset('images/seller-icon.png') }}" alt="Admin" class="nav-icon"> 
        </a>
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/add-book.png') }}" class="nav-icon">Tüm Kitaplar
        </a>
        <a href="{{ route('admin.availableBooks') }}">
            Satıştaki Kitaplar
        </a>
        <a href="/admin/earnings">
            <img src="{{ asset('images/coins.png') }}" class="nav-icon">Kazanç
        </a>
        <a href="{{ route('logout') }}">
            <img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap
        </a>
    </div>
</nav>

<!-- Content -->
<div class="content">
    <h2>Satılan Kitaplar</h2>

    <div class="book-list">
        @forelse ($products as $product)
            <div class="book-card">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>Satış Fiyatı: {{ $product->price }} TL</p>
            </div>
        @empty
            <p>Satılmış kitap bulunmamaktadır.</p>
        @endforelse
    </div>
</div>

</body>
</html>
