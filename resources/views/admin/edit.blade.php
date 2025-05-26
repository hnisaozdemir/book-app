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

    <div class="content">
        <h2>Kitap Güncelle</h2>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 500px;">
            @csrf
            @method('PUT')
            <label>Başlık:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label>Açıklama:</label>
            <textarea name="description" rows="3" required>{{ $product->description }}</textarea>

            <label>Görsel:</label>
            <img src="{{ asset($product->image) }}" width="100" alt="Kitap Görseli"><br>
            <input type="file" name="image" accept="image/*">

            <label>Yazar:</label>
            <input type="text" name="author" value="{{ $product->author }}" required>

            <label>Tür:</label>
            <input type="text" name="type" value="{{ $product->type }}" required>

            <label>Yayın Yılı:</label>
            <input type="number" name="publication_year" value="{{ $product->publication_year }}" required>

            <label>Sayfa Sayısı:</label>
            <input type="number" name="page_count" value="{{ $product->page_count }}" required>

            <label>Fiyat:</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
            
            <div style="margin-top: 15px;">
                <button type="submit" class="btn btn-update">Kaydet</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-delete" style="margin-left: 10px;">Vazgeç</a>
            </div>

        </form>
    </div>

</body>
</html>