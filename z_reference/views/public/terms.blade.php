@extends('layouts.public')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-3xl mx-auto bg-surface border border-border rounded-xl p-8 shadow-2xl">
        <h1 class="text-3xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
            Syarat & Ketentuan (S&K)
        </h1>
        <p class="text-secondary mb-8">
            Halo Sobat Belajar! Sebelum mulai pake Onedayez, baca dulu ya aturan mainnya biar sama-sama enak. Santai aja, gak ribet kok!
        </p>

        <div class="space-y-6 text-gray-300">
            <section>
                <h2 class="text-xl font-bold text-white mb-2">1. Akun Kamu adalah Tanggung Jawabmu</h2>
                <p>Jaga kerahasiaan kata sandi kamu ya. Jangan kasih tau siapa-siapa, apalagi mantan. Segala aktivitas yang terjadi di akunmu itu tanggung jawab kamu sepenuhnya.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">2. Gunakan dengan Bijak</h2>
                <p>Platform ini buat bantu belajar dan cari referensi. Jangan dipake buat hal-hal aneh, apalagi nipu orang. Kita bakal banned akun yang mencurigakan tanpa ragu.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">3. Konten & Hak Cipta</h2>
                <p>Hargai karya kreator lain. Kalau kamu beli atau download konten, itu buat dipake sendiri atau referensi belajar, bukan buat dijual lagi kecuali ada izin lisensi khusus.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">4. Pembayaran & Transaksi</h2>
                <p>Transaksi di sini aman, tapi pastiin kamu transfer ke rekening resmi atau lewat gateway yang udah kita sediain. Hati-hati penipuan yang mengatasnamakan Onedayez.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">5. Perubahan Aturan</h2>
                <p>S&K ini bisa berubah sewaktu-waktu ngikutin perkembangan jaman. Kita bakal infoin kalau ada update penting. Tetep pantau terus ya!</p>
            </section>
        </div>

        <div class="mt-8 pt-6 border-t border-border">
            <p class="text-secondary text-sm">Terakhir diupdate: {{ date('d M Y') }}</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 text-primary hover:text-secondary underline transition-colors">
                &larr; Balik ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
