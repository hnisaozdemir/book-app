<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satıştaki Kitaplar</title>
    <link rel="stylesheet" href="{{ asset('css/available_books.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


<nav class="navbar">
    <div class="navbar-left">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/add-book.png') }}" class="nav-icon">Tüm Kitaplar
        </a>
        <a href="{{ route('admin.soldBooks') }}">Satılan Kitaplar</a>
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

<form action="{{ route('admin.product.delete', $product->id) }}" method="POST" 
      class="delete-form" data-product-name="{{ $product->name }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-delete" type="submit">Sil</button>
</form>
                    </div>
                </div>
            @endforeach
        @else
                <div style="background-color: #fff3cd; border-radius: 10px; padding: 15px 20px; display: flex; align-items: center; font-family: Arial, sans-serif; justify-content:center; width:100%;">
        <span style="font-size: 24px; margin-right: 10px;">🔔</span>
        <span style="color: #856404;">Satışta hiç kitap bulunmamaktadır.</span>
    </div>

        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const deleteForms = document.querySelectorAll('form.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const productName = form.getAttribute('data-product-name');

            Swal.fire({
                title: 'Emin misiniz?',
                text: `"${productName}" adlı ürünü silmek üzeresiniz!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sil',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });


    @if(session('deleted'))
    Swal.fire({
        icon: 'success',
        title: 'Silindi!',
        text: `"{{ session('deleted') }}" adlı kitap silindi.`,
        timer: 2500,
        timerProgressBar: true,
        showConfirmButton: false,
    });
    @endif
});
</script>


</body>
</html>
