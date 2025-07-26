# Laravel LMS - Platform E-Learning Internal Organisasi

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

Selamat datang di Laravel LMS! Project ini adalah sebuah platform Learning Management System (LMS) open-source yang dibangun dengan Laravel 12. Awalnya dirancang dengan fitur pembayaran, kini project ini telah dirombak total menjadi **100% gratis** dan ditujukan untuk menjadi solusi e-learning internal bagi organisasi, perusahaan, atau komunitas yang ingin mengelola materi pelatihan mereka sendiri.

Project ini sangat cocok sebagai starter-kit atau bahan belajar bagi developer yang ingin memahami cara kerja aplikasi LMS yang modular dengan sistem multi-autentikasi di Laravel.

## Fitur Utama

Platform ini membagi fungsionalitas berdasarkan 4 peran pengguna yang berbeda, memastikan manajemen yang terstruktur dan pengalaman belajar yang fokus.

#### System Admin (SysAdmin)
Super user yang memiliki kendali penuh atas seluruh platform.
- Manajemen Akun: Membuat, mengubah, dan menghapus akun Course Admin, Lecturer, dan Student.
- Manajemen Kategori: Mengelola kategori dan sub-kategori kursus secara global.
- Dashboard Statistik: Melihat ringkasan jumlah pengguna dan konten di seluruh sistem.

#### Course Admin
Penanggung jawab yang bertugas membuat dan mengelola konten kursus.
- Manajemen Kursus: Membuat, mengubah, dan menghapus kursus.
- Manajemen Topik & Materi: Menyusun kurikulum dengan menambahkan topik, video (YouTube), materi Google Drive, dan kuis.
- Manajemen Soal Kuis: Membuat soal pilihan ganda beserta kunci jawaban untuk setiap kuis.
- Penugasan Dosen: Menugaskan satu atau lebih dosen (Lecturer) untuk mengampu sebuah kursus.

#### Lecturer (Dosen)
Pengajar yang bertugas memantau perkembangan siswa di kursus yang diampunya.
- Dashboard Dosen: Melihat ringkasan jumlah kursus yang diampu dan total siswa.
- Pemantauan Progres Siswa: Melihat daftar siswa di setiap kursus beserta persentase progres belajar mereka.

#### Student (Siswa)
Peserta yang mengikuti dan menyelesaikan kursus.
- Katalog Kursus: Mencari dan mendaftar ke kursus yang tersedia.
- Halaman Belajar: Mengakses materi kursus (video, GDrive, kuis) secara berurutan.
- Sistem Progres: Materi baru akan terbuka setelah topik sebelumnya diselesaikan 100%.
- Manajemen Profil: Mengubah data diri dan password.
- Sertifikat Otomatis: Mendapatkan sertifikat digital setelah menyelesaikan kursus 100%, lengkap dengan link verifikasi publik yang unik.

---

## Tumpukan Teknologi

* **Framework**: Laravel 12
* **Bahasa**: PHP 8.3
* **Frontend**: Tailwind CSS & Alpine.js (via CDN)
* **Database**: MySQL / SQLite
* **Autentikasi**: Laravel Breeze (konsep multi-guard)

---

## Instalasi & Setup

Yuk, kita jalankan project ini di komputermu!

1.  **Prasyarat**
    - PHP >= 8.2
    - Composer
    - Node.js & NPM
    - Database (MySQL, atau lainnya)

2.  **Clone Repository**
    ```bash
    git clone [https://github.com/NAMAPENGGUNA/NAMA-REPO.git](https://github.com/NAMAPENGGUNA/NAMA-REPO.git)
    cd NAMA-REPO
    ```

3.  **Instalasi Dependensi**
    ```bash
    composer install
    npm install
    ```

4.  **Konfigurasi Environment**
    - Salin file `.env.example` menjadi `.env`.
      ```bash
      cp .env.example .env
      ```
    - Buat *application key* baru.
      ```bash
      php artisan key:generate
      ```
    - Atur koneksi database kamu di file `.env`.
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=laravel_lms
      DB_USERNAME=root
      DB_PASSWORD=
      ```

5.  **Migrasi & Seeding Database**
    Jalankan perintah ini untuk membuat semua tabel dan mengisinya dengan data *dummy* (contoh pengguna, kursus, materi, dll).
    ```bash
    php artisan migrate:fresh --seed
    ```
    *Catatan: Perintah ini akan menghapus semua data lama di database.*

6.  **Build Aset Frontend**
    ```bash
    npm run dev
    ```

7.  **Jalankan Server Development**
    ```bash
    php artisan serve
    ```
    Selesai! Aplikasi sekarang berjalan di `http://127.0.0.1:8000`.

---

## Akun Demo

Setelah menjalankan *seeder*, kamu bisa login menggunakan akun-akun berikut. Password untuk semua akun adalah: `password`

| Peran | URL Login | Email |
| --- | --- | --- |
| **Super Admin** | `/sysadmin/login` | `superadmin@example.com` |
| **Course Admin**| `/course-admin/login` | `course.admin@example.com` |
| **Lecturer** | `/lecturer/login` | `dosen1@example.com` |
| **Student** | `/student/login` | `siswauji@example.com` |

---

## Berkontribusi

Merasa ada yang bisa ditingkatkan? Kontribusi sangat diterima! Silakan:
1.  Fork project ini.
2.  Buat branch baru (`git checkout -b fitur/NamaFitur`).
3.  Commit perubahanmu (`git commit -m 'Menambahkan fitur X'`).
4.  Push ke branch-mu (`git push origin fitur/NamaFitur`).
5.  Buat Pull Request baru.

---

## Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).