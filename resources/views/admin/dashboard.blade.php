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
            <img src="{{ asset('images/seller-icon.png') }}" alt="Satıcı İkonu" class="seller-icon">
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
        </div>
        <div class="navbar-right">
            <a href="#">Satıştaki Kitaplar</a>
            <a href="#">Satılan Kitaplar</a>
            <a href="#"><img src="{{ asset('images/coins.png') }}" class="nav-icon">Kazanç</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>

    <div class="content">
        <div class="product-list" id="productList">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset($product->image) }}" alt="Kitap Görseli" width="150">
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p class="product-price">{{ number_format($product->price, 2) }} ₺</p>
                        <div class="btn-group">
                            <button class="btn btn-update" disabled>Güncelle</button>
                            <button class="btn btn-delete" disabled>Sil</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="add-product-btn" id="addProductBtn">+</button>

        <form id="addProductForm" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Kitap Başlığı</label>
            <input type="text" name="name" id="name" required>

            <label for="description">Açıklama</label>
            <textarea name="description" id="description" rows="3" required></textarea>

            <label for="price">Fiyat (₺)</label>
            <input type="number" step="0.01" name="price" id="price" required>

            <label for="image">Kitap Görseli (opsiyonel)</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit">Kitap Ekle</button>
        </form>
    </div>

    <script>
        const addBtn = document.getElementById('addProductBtn');
        const form = document.getElementById('addProductForm');

        addBtn.addEventListener('click', () => {
            if(form.style.display === 'flex') {
                form.style.display = 'none';
            } else {
                form.style.display = 'flex';
                form.scrollIntoView({behavior: 'smooth'});
            }
        });
    </script>
</body>
</html>
