<!DOCTYPE html>
<html>
<head>
    <title>Sepetim</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>
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
                    <th>Adet</th>
                    <th>Birim Fiyat</th>
                    <th>Toplam</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $subtotal = $details['price'] * $details['quantity']; @endphp
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ number_format($details['price'], 2) }} ₺</td>
                        <td>{{ number_format($subtotal, 2) }} ₺</td>
                    </tr>
                    @php $total += $subtotal; @endphp
                @endforeach
            </tbody>
        </table>

        <h3>Genel Toplam: {{ number_format($total, 2) }} ₺</h3>
    @endif
</body>
</html>
