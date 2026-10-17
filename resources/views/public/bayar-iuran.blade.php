<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Iuran OPBM - Kampung Digital RT 01</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .form-input {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            outline: none;
            transition: all 0.2s;
            background: #ffffff;
        }
        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-emerald-700 text-white rounded-xl flex items-center justify-center font-bold text-sm">RT</div>
                <div>
                    <div class="font-bold text-gray-800 text-sm leading-tight">Informasi Warga</div>
                    <div class="text-xs text-gray-500 leading-tight">RT 01 - Kampung Digital</div>
                </div>
            </a>
            <div class="hidden md:flex gap-6 text-sm">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('cek.iuran') }}" class="text-gray-700 hover:text-emerald-700 transition">Cek Iuran</a>
                <a href="{{ route('bayar.iuran') }}" class="text-emerald-700 font-semibold">Bayar Iuran</a>
            </div>
        </div>
    </nav>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 py-12">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Pembayaran Iuran OPBM</h1>
            <p class="text-gray-500 text-sm">Scan QRIS di bawah ini menggunakan M-Banking atau E-Wallet Anda.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 max-w-2xl mx-auto">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 max-w-2xl mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            
            {{-- KIRI: BANNER QRIS --}}
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100 text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Scan QRIS</h2>
                <p class="text-sm text-gray-500 mb-6">Berlaku untuk semua Bank & E-Wallet</p>
                
                <div class="bg-gray-100 p-4 rounded-2xl mb-4 inline-block">
                    <img src="{{ asset('images/qris-bendahara.jpg') }}" 
                         alt="QRIS Bendahara RT 01" 
                         class="w-64 h-64 object-contain mx-auto mix-blend-multiply">
                </div>
                
                <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 mt-2">
                    <p class="text-sm text-gray-600">Nominal Iuran</p>
                    <p class="text-2xl font-extrabold text-emerald-700">Rp 50.000 / Bulan</p>
                    <p class="text-xs text-emerald-600 mt-1">a.n. Bendahara Paguyuban RT 01</p>
                </div>
            </div>

            {{-- KANAN: FORM KONFIRMASI --}}
            <div class="bg-white p-6 md:p-8 rounded-3xl shadow-lg border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Pembayaran</h2>
                <p class="text-sm text-gray-500 mb-6">Sudah scan dan transfer? Unggah bukti bayar di sini agar diverifikasi Bendahara.</p>

                {{-- ENCTYPE MULTIPART WAJIB ADA UNTUK UPLOAD FILE --}}
                <form action="{{ route('lapor.qris') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <div class="flex">
                            <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-600 font-semibold">+62</span>
                            <input type="text" name="no_hp" placeholder="81234567890" class="form-input" style="border-top-left-radius:0; border-bottom-left-radius:0;" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Bulan <span class="text-red-500">*</span></label>
                            <select name="bulan" class="form-input cursor-pointer" required>
                                @php
                                    $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                @endphp
                                @foreach($namaBulan as $i => $nb)
                                    <option value="{{ $i + 1 }}" @selected($bulanSekarang == ($i + 1))>{{ $nb }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                            <select name="tahun" class="form-input cursor-pointer" required>
                                @for($y = now()->year - 1; $y <= now()->year + 1; $y++)
                                    <option value="{{ $y }}" @selected($tahunSekarang == $y)>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Bukti Transfer (Screenshot) <span class="text-red-500">*</span></label>
                        <input type="file" name="bukti_bayar" accept="image/*" class="form-input" required>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, maks 2MB</p>
                        @error('bukti_bayar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-blue-50 text-blue-800 text-xs p-3 rounded-xl border border-blue-100">
                        ℹ️ Setelah dikirim, status Anda akan berubah menjadi <b>MENUNGGU VALIDASI</b>. Bendahara akan memverifikasi bukti transfer Anda dalam 1x24 jam.
                    </div>

                    <button type="submit" class="w-full text-white px-6 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition text-center mt-2" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                        Kirim Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-sm">
            &copy; {{ date('Y') }} Kampung Digital OPBM RT 01 - Kota Jambi Bahagia
        </div>
    </footer>

</body>
</html>