Writen in Indonesian.

---

# Konsep Buku Aplikasi LMS dengan Laravel Native

Buku ini akan memandu Master Kiannara dalam membangun aplikasi Learning Management System (LMS) dari awal menggunakan Laravel 12 secara native. Stack yang digunakan meliputi Laravel 12, Blade, Tailwind CSS via CDN, SQLite sebagai database lokal, dan Apache2 sebagai server lokal atau produksi ringan.

Proyek akan dibagi dalam dua tahap:

* Minggu 1 dan 2: pengembangan prototipe dasar
* Minggu 3 dan 4: peningkatan menjadi MVP dengan integrasi Midtrans sebagai sistem pembayaran

---

## Minggu 1 dan 2 – Prototipe LMS

### Bab 1: Pengenalan dan Persiapan Lingkungan

**1.1 Pendahuluan Aplikasi LMS**

* Penjelasan singkat tentang LMS dan manfaatnya
* Gambaran fitur yang akan dibangun
* Penjelasan struktur umum: course, topic, materi, kuis
* Tujuan pengembangan prototipe

**1.2 Instalasi Laravel dan Konfigurasi Dasar**

* Instalasi PHP, Composer, dan Laravel
* Pembuatan proyek Laravel
* Penyesuaian `.env` dan struktur dasar proyek

**1.3 Database SQLite**

* Kelebihan SQLite untuk prototipe
* Pembuatan dan konfigurasi file SQLite
* Tes koneksi database

**1.4 Tailwind CSS via CDN**

* Menambahkan Tailwind CDN ke layout utama
* Dasar penggunaan kelas Tailwind

**1.5 Konfigurasi Apache2 (Opsional)**

* Pengaturan virtual host
* Konfigurasi agar Laravel dapat diakses via browser lokal

---

### Bab 2: Perancangan Struktur Database dan Migrasi

**2.1 Rancangan ERD dan Skema Modular**

* Penjelasan visual dan logis tentang relasi antara entitas
* Penekanan pada penggunaan entitas `topics` sebagai pembungkus terstruktur dari video dan kuis

**2.2 Tabel Pengguna Berdasarkan Peran**

* `sysadmins`: pengguna sistem dengan hak penuh
* `course_admins`: pengelola konten kursus
* `lecturers`: dosen atau mentor pembimbing
* `students`: peserta yang mengikuti kursus

**2.3 Tabel Kursus dan Struktur Materi**

* `courses`: data utama kursus
* `topics`: daftar topik dalam satu kursus, disusun secara berurutan
* `videos`: materi video pembelajaran dalam topik
* `quizzes`: kuis yang terkait dengan topik
* `quiz_questions`: pertanyaan kuis
* `quiz_options`: opsi jawaban dari masing-masing pertanyaan

**2.4 Tabel Hubungan dan Progres Belajar**

* `enrollments`: siswa yang mendaftar ke kursus
* `student_topic_progress`: status penyelesaian materi pada setiap topik
* `quiz_attempts`: riwayat percobaan kuis oleh siswa
* `course_lecturer`: pivot table untuk menghubungkan dosen dan kursus

**2.5 Pembuatan dan Eksekusi Migrasi**

* Menulis file migrasi untuk semua tabel
* Menjalankan `php artisan migrate` untuk membentuk struktur database

---

### Bab 3: Sistem Otentikasi dan Otorisasi Pengguna

**3.1 Guard Otentikasi Peran Terpisah**

* Konfigurasi multiple guard untuk setiap peran pengguna
* Penyesuaian file `auth.php`

**3.2 Form Login dan Logout Peran**

* Form login untuk masing-masing peran
* Sistem logout dan validasi akses

**3.3 Middleware Akses Berdasarkan Peran**

* Membuat middleware custom
* Implementasi pada route group Laravel

**3.4 Dashboard Peran Berbeda**

* Template layout umum
* Dashboard berbeda untuk sysadmin, course admin, lecturer, dan student

---

### Bab 4: Modul Sysadmin

**4.1 Manajemen Pengguna**

* CRUD untuk course admin, lecturer, dan student
* Validasi input dan hashing password

**4.2 Konfigurasi Sistem Sederhana**

* Pengaturan nama situs, logo, dan pengaturan global sederhana

---

### Bab 5: Modul Course Admin

**5.1 Pengelolaan Kursus**

* Membuat, mengedit, dan menghapus kursus
* Menghubungkan kursus ke course admin yang membuatnya

**5.2 Manajemen Topik Kursus**

* Menambah dan mengurutkan topik secara manual
* Sistem urutan topik yang menentukan alur pembelajaran

**5.3 Manajemen Konten dalam Topik**

* Penambahan video ke dalam topik
* Penambahan kuis ke dalam topik beserta pertanyaan dan jawaban

**5.4 Penugasan Dosen ke Kursus**

* Memilih dosen untuk setiap kursus dari daftar lecturer

---

### Bab 6: Modul Lecturer

**6.1 Daftar Kursus yang Diampu**

* Tampilan daftar kursus yang ditugaskan

**6.2 Akses Konten Kursus**

* Tampilan konten video dan kuis dalam mode read-only

**6.3 Pantauan Progres Siswa**

* Menampilkan daftar siswa terdaftar
* Melihat progres penyelesaian topik dan hasil kuis

---

### Bab 7: Modul Student

**7.1 Daftar Kursus dan Pendaftaran**

* Menampilkan kursus yang tersedia
* Proses pendaftaran ke kursus

**7.2 Detail Kursus dan Topik**

* Tampilan urutan topik dalam kursus
* Indikator progres per topik

**7.3 Interaksi Materi**

* Pemutar video menggunakan YouTube embed
* Sistem tanda selesai untuk video
* Akses topik berikutnya setelah topik sebelumnya selesai

**7.4 Pengerjaan Kuis**

* Tampilan kuis dan opsi jawaban
* Validasi dan penilaian otomatis
* Penyimpanan skor dan status kelulusan
* Izin mencoba ulang jika tidak lulus

---

### Bab 8: Fitur Tambahan

**8.1 Notifikasi Ringan**

* Notifikasi berbasis session atau toast sederhana untuk event penting

**8.2 Pencarian dan Paginasi**

* Implementasi fitur pencarian dan paginasi untuk data besar

**8.3 Validasi dan Penanganan Error**

* Validasi input pengguna
* Menampilkan pesan error yang ramah

**8.4 Keamanan Dasar**

* Perlindungan terhadap XSS dan CSRF

---

### Bab 9: Deployment ke Server Apache2

**9.1 Persiapan Server**

* Instalasi Apache2 dan konfigurasi modul dasar

**9.2 Proses Deployment**

* Upload kode
* Instalasi dependency
* Menjalankan migrasi

**9.3 Konfigurasi Virtual Host**

* Menyesuaikan domain atau subdomain untuk aplikasi
* Keamanan direktori Laravel

---

## Minggu 3 dan 4 – Pengembangan MVP dengan Midtrans

Bagian ini akan ditulis setelah fase prototipe selesai. Fokus utama meliputi:

* Pembuatan sistem pembayaran dengan Midtrans (Snap atau API)
* Penerapan status akses course berdasarkan pembayaran
* Validasi otomatis pembayaran dan enrollment

---
