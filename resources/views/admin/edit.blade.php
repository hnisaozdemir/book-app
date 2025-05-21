<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kitap Güncelle</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.jpg') }}" alt="Satıcı İkonu" class="seller-icon">
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
        </div>
        <div class="navbar-right">
            <a href="{{ route('admin.dashboard') }}">Satıştaki Kitaplar</a>
            <a href="#">Satılan Kitaplar</a>
            <a href="#"><img src="{{ asset('images/coins.jpg') }}" class="nav-icon">Kazanç</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.jpg') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <div class="content">
        <h2>Kitap Güncelle</h2>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 500px;">
            @csrf
            @method('PUT')
            <label>Başlık:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label>Açıklama:</label>
            <textarea name="description" rows="3" required>{{ $product->description }}</textarea>

            <label>Fiyat:</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>

            <label>Görsel:</label>
            <img src="{{ asset($product->image) }}" width="100" alt="Kitap Görseli"><br>
            <input type="file" name="image" accept="image/*">

            <div style="margin-top: 15px;">
                <button type="submit" class="btn btn-update">Kaydet</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-delete" style="margin-left: 10px;">Vazgeç</a>
            </div>
        </form>
    </div>

</body>
</html>