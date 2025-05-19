<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satıcı Paneli</title>
    <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/seller-icon.png') }}" alt="Satıcı İkonu" class="seller-icon">
            <span>Hoş geldiniz, Satıcı XX</span>
        </div>

        <div class="navbar-right">
            <a href="satis-kitaplar.html">Satıştaki Kitaplar</a>
            <a href="satilan-kitaplar.html">Satılan Kitaplar</a>

    <a href="kazanc.html">
        <img src="{{ asset('images/coins.png') }}" alt="Kazanç İkonu" class="nav-icon">
        Kazanç
    </a>


    <a href="cikis.html">
        <img src="{{ asset('images/user-logout.png') }}" alt="Çıkış İkonu" class="nav-icon">
        Çıkış Yap
    </a>
        </div>
    </nav>

    <div class="content">

    </div>

</body>
</html>
