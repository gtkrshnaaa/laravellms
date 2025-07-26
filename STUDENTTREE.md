```bash
.
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   └── Student/
│   │   │       ├── Auth/                           # (REVISI) Controller otentikasi dipisah
│   │   │       │   ├── StudentLoginController.php      # Khusus menangani form & proses login/logout
│   │   │       │   └── StudentRegisterController.php   # Khusus menangani form & proses registrasi
│   │   │       │
│   │   │       ├── StudentDashboardController.php      # Controller untuk halaman utama setelah login
│   │   │       ├── StudentCourseController.php         # Menampilkan katalog SEMUA kursus yang tersedia
│   │   │       ├── StudentEnrolledCourseController.php # Mengelola kursus yang SUDAH diikuti student
│   │   │       └── StudentProfileController.php        # (Opsional) Mengelola profil dan ganti password
│   │   │
│   │   └── Middleware/
│   │       └── StudentAuth.php                       # Middleware untuk proteksi route student
│   │
│   └── Models/
│       └── Student.php                             # Model Authenticatable untuk tabel 'students'
│
├── resources
│   └── views
│       ├── student/
│       │   ├── auth/
│       │   │   ├── login.blade.php                 # Form untuk StudentLoginController
│       │   │   └── register.blade.php              # Form untuk StudentRegisterController
│       │   │
│       │   ├── dashboard.blade.php                 # View dashboard utama student
│       │   │
│       │   ├── courses/
│       │   │   ├── index.blade.php                 # View untuk daftar semua kursus (katalog)
│       │   │   └── show.blade.php                  # View detail kursus publik (sebelum daftar)
│       │   │
│       │   ├── enrolled_course/
│       │   │   ├── index.blade.php                 # View "Kursus Saya", daftar kursus yang sudah diikuti
│       │   │   └── show.blade.php                  # View halaman belajar (video, kuis, progres)
│       │   │
│       │   └── profile/
│       │       └── edit.blade.php                  # View untuk form edit profil/password
│       │
│       └── layouts/
│           └── student.blade.php                   # Template layout utama untuk panel student
│
└── routes
    └── web.php                                     # Tempat untuk grup route 'student'

```