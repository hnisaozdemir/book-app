<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satıcı Paneli</title>
    <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}">
</head>
<body>
<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">

        @if(session('show_welcome'))
            <span class="welcome-text" id="welcome-message">Hoş geldiniz, {{ Auth::user()->name }}</span>
        @endif
    </div>

    <div class="navbar-right">
        <div class="link-group close-group">
            <img src="{{ asset('images/books.png') }}" alt="Book Icon" class="nav-icon book-icon">
            <a href="{{ route('admin.availableBooks') }}">Satıştaki Kitaplar</a>
            <span class="divider">|</span>
            <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
        </div>

        <div class="link-group normal-group">
            <img src="{{ asset('images/seller-orders.png') }}" alt="Orders Icon" class="nav-icon orders-icon">
            <a href="{{ route('admin.orders') }}">Siparişler</a>
            <a href="/admin/earnings">
                <img src="{{ asset('images/coins.png') }}" class="nav-icon">Kazanç
            </a>
            <a href="{{ route('admin.profile') }}">
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
    </div>
</nav>

<h2 class="page-title">Tüm Kitaplar</h2>

<div class="content">
    <div class="product-list" id="productList">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset($product->image) }}" alt="Kitap Görseli" width="150">
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p class="product-price">{{ number_format($product->price, 2) }} ₺</p>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('admin.add_books') }}" class="add-product-btn" id="addProductBtn">Kitap Ekle</a>
</div>

@if(session('show_welcome'))
<script>
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const welcomeMessage = document.getElementById('welcome-message');
            if (welcomeMessage) {
                welcomeMessage.style.transition = 'opacity 1s ease';
                welcomeMessage.style.opacity = '0';
                setTimeout(() => welcomeMessage.remove(), 1000);
            }
        }, 4000);
    });
</script>

@php
    session()->forget('show_welcome');
@endphp
@endif

<script>
    function toggleUpdateForm(id) {
        const form = document.getElementById('updateForm-' + id);
        if (form.style.display === 'block') {
            form.style.display = 'none';
        } else {
            form.style.display = 'block';
            form.scrollIntoView({behavior: 'smooth'});
        }
    }
</script>

</body>
</html>
