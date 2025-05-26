<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kitap Ekle</title>
    <link rel="stylesheet" href="{{ asset('css/add_book.css') }}?v={{ time() }}">
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
        <a href="{{ route('admin.dashboard') }}">Satıştaki Kitaplar</a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
        <a href="{{ route('admin.earnings') }}"><img src="{{ asset('images/coins.png') }}" class="nav-icon">Kazanç</a>
        <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
    </div>
</nav>

<h2 class="page-title">Yeni Kitap Ekle</h2>

<div class="content">
  <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form">
    @csrf

    <label for="name">Kitap Başlığı</label>
    <input type="text" name="name" id="name" required>

    <label for="author">Yazar</label>
    <input type="text" name="author" id="author" required>

    <label for="type">Tür</label>
    <input type="text" name="type" id="type" required>

    <label for="publication_year">Basım Yılı</label>
    <input type="number" name="publication_year" id="publication_year" min="1500" max="{{ date('Y') }}" required>

    <label for="page_count">Sayfa Sayısı</label>
    <input type="number" name="page_count" id="page_count" min="1" required>

    <label for="description">Açıklama</label>
    <textarea name="description" id="description" rows="3" required></textarea>

    <label for="price">Fiyat (₺)</label>
    <input type="number" step="0.01" name="price" id="price" required>

    <label for="image">Kitap Görseli (opsiyonel)</label>
    <input type="file" name="image" id="image" accept="image/*">

    <div>
        <button type="submit" class="btn btn-add">Kitap Ekle</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-delete">Vazgeç</a>
    </div>
</form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

</body>
</html>
