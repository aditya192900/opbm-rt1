<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampung Digital OPBM RT 01 - Kota Jambi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <nav class="bg-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="font-bold text-xl">OPBM RT 01</div>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-green-700 px-4 py-2 rounded-lg font-semibold">
                        Masuk Beranda
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-green-700 px-4 py-2 rounded-lg font-semibold">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-800 text-white px-4 py-2 rounded-lg font-semibold border border-white">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-20 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Kampung Digital OPBM RT 01
            </h1>
            <p class="text-lg md:text-xl mb-8 opacity-90">
                Sistem Pengelolaan Sampah Berbasis Masyarakat - Menuju Kota Jambi Bahagia
            </p>
            <div class="flex gap-4 justify-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100">
                        Masuk ke Beranda RT
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100">
                        Login ke Beranda RT
                    </a>
                    <a href="{{ route('register') }}" class="bg-yellow-500 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-yellow-600">
                        Daftar Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- FITUR --}}
    <section class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">
            Layanan Digital RT 01
        </h2>
        <p class="text-center text-gray-500 mb-12">
            Wajib login untuk mengakses seluruh layanan
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold text-green-600">
                    1
                </div>
                <h3 class="font-bold text-lg mb-2">Jadwal OPBM</h3>
                <p class="text-gray-500 text-sm">Lihat jadwal penjemputan sampah di lingkungan RT 01</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold text-blue-600">
                    2
                </div>
                <h3 class="font-bold text-lg mb-2">Pendaftaran OPBM</h3>
                <p class="text-gray-500 text-sm">Daftar sebagai peserta layanan penjemputan sampah</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold text-yellow-600">
                    3
                </div>
                <h3 class="font-bold text-lg mb-2">Laporan Warga</h3>
                <p class="text-gray-500 text-sm">Laporkan masalah sampah dengan cepat dan mudah</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold text-purple-600">
                    4
                </div>
                <h3 class="font-bold text-lg mb-2">UMKM Warga</h3>
                <p class="text-gray-500 text-sm">Direktori usaha warga RT 01 yang bisa dihubungi</p>
            </div>
        </div>
    </section>

    {{-- TENTANG OPBM --}}
    <section class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Apa itu OPBM?</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                <strong>OPBM (Operator Pengumpul Sampah Berbasis Masyarakat)</strong> adalah program Pemerintah Kota Jambi
                di bawah Wali Kota Maulana untuk mengatasi masalah sampah dengan sistem penjemputan langsung dari rumah warga.
                Sampah diangkut menggunakan bentor menuju depo transfer, dan TPS liar secara bertahap akan ditutup.
            </p>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-green-700 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Bergabung?</h2>
            <p class="text-lg mb-8 opacity-90">
                Login atau daftar sekarang untuk mengakses beranda RT 01 dan seluruh layanan digital
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold text-lg">
                    Masuk Beranda
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold text-lg">
                    Login Sekarang
                </a>
            @endauth
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-800 text-gray-300 py-8 text-center">
        <p>&copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia</p>
        <p class="text-sm mt-2">Kompetisi Kampung Digital 2026 - Jambi Smart City Fest</p>
    </footer>

</body>
</html>