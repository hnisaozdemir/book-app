<!DOCTYPE html>
<html>
<head>
    <title>Sepetim</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body>

<nav class="navbar">
    <div class="navbar-left">
<img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    </div>
    <div class="navbar-right">
        <a href="{{ route('user.dashboard') }}"><img src="{{ asset('images/main-page.png') }}" class="nav-icon">Anasayfa</a>
        <a href="{{ route('user.orders') }}"><img src="{{ asset('images/orders.png') }}" class="nav-icon" alt="Siparişlerim İkonu">Siparişlerim</a>
        <a href="{{ route('user.profile') }}">
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

<div class="cart-container">
    <h2 class="cart-title">Sepetiniz</h2>

    @if (session('message'))
    <div class="toast-message">
        {{ session('message') }}
    </div>
    @endif

    @if($cartItems->count() == 0)
        <p class="empty-cart">Sepetinizde ürün yok.</p>
    @else
        @foreach($cartItems as $item)
            <div class="cart-item">
                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/100x120' }}" alt="Ürün Resmi">
                <div class="cart-item-info">
                    <h4>{{ $item->product->name }}</h4>
                    <div class="cart-item-price">{{ number_format($item->product->price, 2) }} ₺</div>
                    <div class="cart-item-quantity">Adet: {{ $item->quantity }}</div>
                </div>

            <form action="{{ route('user.cart.remove', $item->product->id) }}" method="POST"
                class="delete-form"
                data-product-name="{{ $item->product->name }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Sil</button>
            </form>

            </div>
        @endforeach

        <a href="{{ route('user.address') }}" class="btn btn-confirm">Siparişi Onayla</a>
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 15px;">Geri Dön</a>
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
    });

    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.querySelector('.toast-message');
        if (toast) {
            setTimeout(() => {
                toast.remove();
            }, 4500); // Animasyon sonrası tamamen kaldır
        }
    });
</script>



</body>
</html>
