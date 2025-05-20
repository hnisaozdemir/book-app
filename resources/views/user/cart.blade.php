<!DOCTYPE html>
<html>
<head>
    <title>Sepetim</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>
@if (session('message'))
    <div style="background-color: #d4edda; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; color: #155724;">
        {{ session('message') }}
    </div>
@endif

    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.png') }}" alt="Kullanıcı ikonu" class="seller-icon">
            <span>Hoş geldiniz, {{ Auth::user()->name }}</span>
        </div>
        <div class="navbar-right">
            <a href="{{ route('user.cart') }}"><img src="{{ asset('images/shopping-cart.png') }}" class="nav-icon">Sepet</a>
            <a href="{{ route('logout') }}"><img src="{{ asset('images/user-logout.png') }}" class="nav-icon">Çıkış Yap</a>
        </div>
    </nav>



    <h2>Sepetiniz</h2>

    @if(count($cart) == 0)
        <p>Sepetiniz boş.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Fiyat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ number_format($details['price'], 2) }} ₺</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn btn-view" style="margin-top: 20px; display: inline-block;">Geri Dön</a>

</body>
</html>
