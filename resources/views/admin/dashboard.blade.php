<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
</head>
<body>
    <h1>Seller Paneline Hoş Geldiniz</h1>

    <p><strong>Adınız:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Rol:</strong> {{ Auth::user()->role }}</p>

    <a href="{{ route('logout') }}">Çıkış Yap</a>
</body>
</html>
