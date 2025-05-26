<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satıştaki Kitaplar</title>
    <link rel="stylesheet" href="{{ asset('css/available_books.css') }}">
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
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/add-book.png') }}" class="nav-icon">Tüm Kitaplar
        </a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
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

<div class="content">
    <div class="book-list">
        @if($products->where('is_sold', 0)->count())
            @foreach($products->where('is_sold', 0) as $product)
                <div class="book-card">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>Fiyat: {{ $product->price }} TL</p>

                    <div class="button-group">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-update">Güncelle</a>

                        <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Emin misiniz?')" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" type="submit">Sil</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>Satışta kitap bulunmamaktadır.</p>
        @endif
    </div>
</div>

</body>
</html>
