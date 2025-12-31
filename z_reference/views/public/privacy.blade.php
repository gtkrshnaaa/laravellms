@extends('layouts.public')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-3xl mx-auto bg-surface border border-border rounded-xl p-8 shadow-2xl">
        <h1 class="text-3xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
            Kebijakan Privasi
        </h1>
        <p class="text-secondary mb-8">
            Tenang sob, data lo aman sama kita. Kita curhat dulu bentar soal gimana kita ngurus data-data penting lo, biar lo gak overthinking.
        </p>

        <div class="space-y-6 text-gray-300">
            <section>
                <h2 class="text-xl font-bold text-white mb-2">1. Data Apa Aja yang Kita Simpen?</h2>
                <p>Kita cuma simpen data yang lo kasih pas daftar, kayak nama, email, sama password (yang udah di-encrypt pastinya). Kita juga nyateter IP address lo buat keamanan sistem doang, bukan buat stalking.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">2. Buat Apa Data Lo?</h2>
                <p>Simpel: biar lo bisa login, beli produk, dan akses dashboard. Kita gak bakal jual data lo ke pinjol atau pihak ketiga yang gak jelas. Trust is key, bro.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">3. Cookies (Bukan Kue)</h2>
                <p>Website ini pake cookies biar lo gak perlu bolak-balik login tiap buka halaman baru. Kalau lo ngerasa keganggu, lo bisa matiin cookies di browser lo, tapi nanti experience-nya jadi kurang smooth.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">4. Pihak Ketiga</h2>
                <p>Buat pembayaran, kita pake payment gateway tepercaya (kayak Mayar/Gumroad). Data kartu kredit lo urusan mereka, kita gak nyimpen data sensitif pembayaran lo di server kita.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-white mb-2">5. Update Kebijakan</h2>
                <p>Kalau ada update soal privasi, kita bakal kabarin. Tapi intinya satu: kita ngejaga privasi lo kayak ngejaga rahasia bestie sendiri.</p>
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
