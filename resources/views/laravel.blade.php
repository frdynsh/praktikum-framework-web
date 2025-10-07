<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/laravel.css') }}">
</head>
<body>
     <!-- Navigasi -->
<header class="navbar">
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('laravel') }}">Laravel</a>
    </nav>
</header>

    <section class="banner">
        <div class="banner-content">
            <img src="{{ asset('images/logo.png') }}" alt="Laravel Logo">
        </div>
    </section>

    <!-- Konten Halaman -->
    <div class="content">
        <h1>Apa itu Laravel?</h1>
        <p>Laravel adalah <b>framework aplikasi web berbasis php</b> yang dirancang untuk mempermudah developer membangun aplikasi modern. </p>

        <h2>Fitur Utama Laravel</h2>
        <ul>
            <li><b>MVC (Model–View–Controller)</b> —> membuat kode lebih rapi dan terstruktur.</li>
            <li><b>Sintaks elegan & ekspresif</b> —> mudah dibaca dan dipelihara.</li>
            <li><b>Routing sederhana</b> —> memetakan URL ke fungsi/aksi dengan mudah.</li>
            <li><b>ORM Eloquent</b> —> interaksi dengan database tanpa query SQL mentah.</li>
            <li><b>Fitur bawaan lengkap</b> —> autentikasi, session, middleware, Blade template, API, queue, dan testing.</li>
            <li><b>Ekosistem luas</b> —> banyak package tersedia untuk berbagai kebutuhan.</li>
            <li><b>Komunitas besar</b> —> dokumentasi dan dukungan komunitas melimpah.</li>
        </ul>

        <p>
            Singkatnya, <i>Laravel</i> adalah alat bantu yang mempercepat dan mempermudah pembuatan aplikasi web dengan PHP, sehingga hasilnya lebih rapi, aman, dan modern.
        </p>
    </div>
    
</body>
</html>
