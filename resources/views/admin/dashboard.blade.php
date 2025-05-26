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
        <a href="{{ route('admin.profile') }}">
            <img src="{{ asset('images/seller-icon.png') }}" alt="Admin" class="nav-icon seller-icon"> 
        </a>
        <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
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
            <a href="{{ route('logout') }}">
                <img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap
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
