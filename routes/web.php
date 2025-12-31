<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PublicPage\PublicPageLandingPageController;
use App\Http\Controllers\PublicPage\PublicCertificateController;

Route::get('/', [PublicPageLandingPageController::class, 'index'])->name('landingpage');
Route::get('/course/{course}', [PublicPageLandingPageController::class, 'show'])->name('course.show.public');
Route::get('/certificate/verify/{token}', [PublicCertificateController::class, 'show'])->name('certificate.verify.public');






// == SYSADMIN AREA ==
use App\Http\Controllers\SysAdmin\Auth\SysAdminLoginController;
use App\Http\Controllers\SysAdmin\SysAdminDashboardController;
use App\Http\Controllers\SysAdmin\SysAdminManageSysAdminController;
use App\Http\Controllers\SysAdmin\SysAdminManageCourseAdminController;
use App\Http\Controllers\SysAdmin\SysAdminManageLecturerController;
use App\Http\Controllers\SysAdmin\SysAdminManageStudentController;
use App\Http\Controllers\SysAdmin\SysAdminManageCourseCategoryController;
use App\Http\Controllers\SysAdmin\SysAdminManageCourseSubCategoryController;




Route::prefix('sysadmin')->name('sysadmin.')->group(function () {
    
    // Auth
    Route::get('login', [SysAdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [SysAdminLoginController::class, 'login'])->name('login.post');

    // Rute yang hanya bisa diakses oleh sysadmin yang sudah login
    Route::middleware('sysadmin')->group(function () {
        Route::post('logout', [SysAdminLoginController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('dashboard', [SysAdminDashboardController::class, 'index'])->name('dashboard');

        // Admin Management (khusus superadmin)
        Route::get('manage_sysadmin', [SysAdminManageSysAdminController::class, 'index'])->name('manage_sysadmin.index');
        Route::get('manage_sysadmin/create', [SysAdminManageSysAdminController::class, 'create'])->name('manage_sysadmin.create');
        Route::post('manage_sysadmin', [SysAdminManageSysAdminController::class, 'store'])->name('manage_sysadmin.store');
        Route::get('manage_sysadmin/{sysadmin}/edit', [SysAdminManageSysAdminController::class, 'edit'])->name('manage_sysadmin.edit');
        Route::put('manage_sysadmin/{sysadmin}', [SysAdminManageSysAdminController::class, 'update'])->name('manage_sysadmin.update');
        Route::delete('manage_sysadmin/{sysadmin}', [SysAdminManageSysAdminController::class, 'destroy'])->name('manage_sysadmin.destroy');


        // Course Admin Management
        Route::get('manage_course_admin', [SysAdminManageCourseAdminController::class, 'index'])->name('manage_course_admin.index');
        Route::get('manage_course_admin/create', [SysAdminManageCourseAdminController::class, 'create'])->name('manage_course_admin.create');
        Route::post('manage_course_admin', [SysAdminManageCourseAdminController::class, 'store'])->name('manage_course_admin.store');
        Route::get('manage_course_admin/{courseAdmin}/edit', [SysAdminManageCourseAdminController::class, 'edit'])->name('manage_course_admin.edit');
        Route::put('manage_course_admin/{courseAdmin}', [SysAdminManageCourseAdminController::class, 'update'])->name('manage_course_admin.update');
        Route::delete('manage_course_admin/{courseAdmin}', [SysAdminManageCourseAdminController::class, 'destroy'])->name('manage_course_admin.destroy');

        // Lecturer Management
        Route::get('manage_lecturer', [SysAdminManageLecturerController::class, 'index'])->name('manage_lecturer.index');
        Route::get('manage_lecturer/create', [SysAdminManageLecturerController::class, 'create'])->name('manage_lecturer.create');
        Route::post('manage_lecturer', [SysAdminManageLecturerController::class, 'store'])->name('manage_lecturer.store');
        Route::get('manage_lecturer/{lecturer}/edit', [SysAdminManageLecturerController::class, 'edit'])->name('manage_lecturer.edit');
        Route::put('manage_lecturer/{lecturer}', [SysAdminManageLecturerController::class, 'update'])->name('manage_lecturer.update');
        Route::delete('manage_lecturer/{lecturer}', [SysAdminManageLecturerController::class, 'destroy'])->name('manage_lecturer.destroy');
                    
        // ==== Student Management ====
        Route::get('manage_student', [SysAdminManageStudentController::class, 'index'])->name('manage_student.index');
        Route::get('manage_student/create', [SysAdminManageStudentController::class, 'create'])->name('manage_student.create');
        Route::post('manage_student', [SysAdminManageStudentController::class, 'store'])->name('manage_student.store');
        Route::get('manage_student/{student}/edit', [SysAdminManageStudentController::class, 'edit'])->name('manage_student.edit');
        Route::put('manage_student/{student}', [SysAdminManageStudentController::class, 'update'])->name('manage_student.update');
        Route::delete('manage_student/{student}', [SysAdminManageStudentController::class, 'destroy'])->name('manage_student.destroy');
        
        // === KATEGORI & SUB-KATEGORI ===
        // --- Rute untuk Kategori ---
        Route::get('manage-categories', [SysAdminManageCourseCategoryController::class, 'index'])->name('manage-categories.index');
        Route::get('manage-categories/create', [SysAdminManageCourseCategoryController::class, 'create'])->name('manage-categories.create');
        Route::post('manage-categories', [SysAdminManageCourseCategoryController::class, 'store'])->name('manage-categories.store');
        Route::get('manage-categories/{category}/edit', [SysAdminManageCourseCategoryController::class, 'edit'])->name('manage-categories.edit');
        Route::put('manage-categories/{category}', [SysAdminManageCourseCategoryController::class, 'update'])->name('manage-categories.update');
        Route::delete('manage-categories/{category}', [SysAdminManageCourseCategoryController::class, 'destroy'])->name('manage-categories.destroy');
        
        // --- Rute untuk Sub-Kategori ---
        Route::get('manage-categories/{category}/sub-categories', [SysAdminManageCourseSubCategoryController::class, 'index'])->name('manage-sub-categories.index');
        Route::post('manage-categories/{category}/sub-categories', [SysAdminManageCourseSubCategoryController::class, 'store'])->name('manage-sub-categories.store');
        Route::get('manage-sub-categories/{subCategory}/edit', [SysAdminManageCourseSubCategoryController::class, 'edit'])->name('manage-sub-categories.edit');
        Route::put('manage-sub-categories/{subCategory}', [SysAdminManageCourseSubCategoryController::class, 'update'])->name('manage-sub-categories.update');
        Route::delete('manage-sub-categories/{subCategory}', [SysAdminManageCourseSubCategoryController::class, 'destroy'])->name('manage-sub-categories.destroy');

        
    });
});




// == COURSE ADMIN AREA ==

use App\Http\Controllers\CourseAdmin\Auth\CourseAdminLoginController;
use App\Http\Controllers\CourseAdmin\CourseAdminDashboardController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseTopicController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseTopicVideoController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseTopicQuizController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseTopicQuizQuestionController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseLecturerController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageCourseTopicGoogleDriveController;
use App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminManageFollowUpLinkController;

// == COURSE ADMIN ==
Route::prefix('course-admin')->name('course_admin.')->group(function () {
    // Auth Routes
    Route::get('login', [CourseAdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CourseAdminLoginController::class, 'login'])->name('login.post');

    // Authenticated Routes
    Route::middleware('courseadmin')->group(function () {
        Route::post('logout', [CourseAdminLoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [CourseAdminDashboardController::class, 'index'])->name('dashboard');

        // == MANAJEMEN KURSUS ==
        Route::prefix('management')->name('management.')->group(function() {

            // --- CRUD untuk Course ---
            Route::get('courses', [CourseAdminManageCourseController::class, 'index'])->name('courses.index');
            Route::get('courses/create', [CourseAdminManageCourseController::class, 'create'])->name('courses.create');
            Route::post('courses', [CourseAdminManageCourseController::class, 'store'])->name('courses.store');
            Route::get('courses/{course}', [CourseAdminManageCourseController::class, 'show'])->name('courses.show');
            Route::get('courses/{course}/edit', [CourseAdminManageCourseController::class, 'edit'])->name('courses.edit');
            Route::put('courses/{course}', [CourseAdminManageCourseController::class, 'update'])->name('courses.update');
            Route::delete('courses/{course}', [CourseAdminManageCourseController::class, 'destroy'])->name('courses.destroy');

            // --- CRUD untuk Topik (bersarang di Course) ---
            Route::get('courses/{course}/topics/create', [CourseAdminManageCourseTopicController::class, 'create'])->name('courses.topics.create');
            Route::post('courses/{course}/topics', [CourseAdminManageCourseTopicController::class, 'store'])->name('courses.topics.store');
            Route::get('courses/{course}/topics/{topic}/edit', [CourseAdminManageCourseTopicController::class, 'edit'])->name('courses.topics.edit');
            Route::put('courses/{course}/topics/{topic}', [CourseAdminManageCourseTopicController::class, 'update'])->name('courses.topics.update');
            Route::delete('courses/{course}/topics/{topic}', [CourseAdminManageCourseTopicController::class, 'destroy'])->name('courses.topics.destroy');
            
            // --- Rute kustom untuk menampilkan halaman kelola materi ---
            Route::get('topics/{topic}/materials', [CourseAdminManageCourseTopicController::class, 'showMaterials'])->name('topics.materials');
            
            // --- CRUD untuk Video (bersarang di Topik) ---
            Route::get('topics/{topic}/videos/create', [CourseAdminManageCourseTopicVideoController::class, 'create'])->name('topics.videos.create');
            Route::post('topics/{topic}/videos', [CourseAdminManageCourseTopicVideoController::class, 'store'])->name('topics.videos.store');
            Route::get('topics/{topic}/videos/{video}/edit', [CourseAdminManageCourseTopicVideoController::class, 'edit'])->name('topics.videos.edit');
            Route::put('topics/{topic}/videos/{video}', [CourseAdminManageCourseTopicVideoController::class, 'update'])->name('topics.videos.update');
            Route::delete('topics/{topic}/videos/{video}', [CourseAdminManageCourseTopicVideoController::class, 'destroy'])->name('topics.videos.destroy');

            // --- CRUD untuk Kuis (bersarang di Topik) ---
            Route::get('topics/{topic}/quizzes/create', [CourseAdminManageCourseTopicQuizController::class, 'create'])->name('topics.quizzes.create');
            Route::post('topics/{topic}/quizzes', [CourseAdminManageCourseTopicQuizController::class, 'store'])->name('topics.quizzes.store');
            Route::get('topics/{topic}/quizzes/{quiz}/edit', [CourseAdminManageCourseTopicQuizController::class, 'edit'])->name('topics.quizzes.edit');
            Route::put('topics/{topic}/quizzes/{quiz}', [CourseAdminManageCourseTopicQuizController::class, 'update'])->name('topics.quizzes.update');
            Route::delete('topics/{topic}/quizzes/{quiz}', [CourseAdminManageCourseTopicQuizController::class, 'destroy'])->name('topics.quizzes.destroy');

            // --- CRUD untuk Materi Google Drive (bersarang di Topik) ---
            Route::get('topics/{topic}/googledrive/create', [CourseAdminManageCourseTopicGoogleDriveController::class, 'create'])->name('topics.googledrive.create');
            Route::post('topics/{topic}/googledrive', [CourseAdminManageCourseTopicGoogleDriveController::class, 'store'])->name('topics.googledrive.store');
            Route::get('topics/{topic}/googledrive/{googleDriveMaterial}/edit', [CourseAdminManageCourseTopicGoogleDriveController::class, 'edit'])->name('topics.googledrive.edit');
            Route::put('topics/{topic}/googledrive/{googleDriveMaterial}', [CourseAdminManageCourseTopicGoogleDriveController::class, 'update'])->name('topics.googledrive.update');
            Route::delete('topics/{topic}/googledrive/{googleDriveMaterial}', [CourseAdminManageCourseTopicGoogleDriveController::class, 'destroy'])->name('topics.googledrive.destroy');
            // --- END ---

            // --- CRUD untuk Soal Kuis (bersarang di Kuis) ---
            Route::get('quizzes/{quiz}/questions', [CourseAdminManageCourseTopicQuizQuestionController::class, 'index'])->name('quizzes.questions.index');
            Route::post('quizzes/{quiz}/questions', [CourseAdminManageCourseTopicQuizQuestionController::class, 'store'])->name('quizzes.questions.store');

            Route::get('quizzes/{quiz}/questions/{question}/edit', [CourseAdminManageCourseTopicQuizQuestionController::class, 'edit'])->name('quizzes.questions.edit');
            Route::put('quizzes/{quiz}/questions/{question}', [CourseAdminManageCourseTopicQuizQuestionController::class, 'update'])->name('quizzes.questions.update');
            Route::delete('quizzes/{quiz}/questions/{question}', [CourseAdminManageCourseTopicQuizQuestionController::class, 'destroy'])->name('quizzes.questions.destroy');

            // --- Rute untuk Assign Lecturer ---
            Route::get('courses/{course}/lecturers', [CourseAdminManageCourseLecturerController::class, 'index'])->name('courses.lecturers.index');
            Route::post('courses/{course}/lecturers', [CourseAdminManageCourseLecturerController::class, 'store'])->name('courses.lecturers.store');

            Route::post('courses/{course}/follow-up-links', [CourseAdminManageFollowUpLinkController::class, 'store'])->name('courses.follow_up_links.store');
            Route::delete('follow-up-links/{link}', [CourseAdminManageFollowUpLinkController::class, 'destroy'])->name('follow_up_links.destroy');

            // --- Batch Enrollment ---
            Route::get('batch-enrollment/create', [\App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminBatchEnrollmentController::class, 'create'])->name('batch_enrollment.create');
            Route::post('batch-enrollment', [\App\Http\Controllers\CourseAdmin\CourseManagement\CourseAdminBatchEnrollmentController::class, 'store'])->name('batch_enrollment.store');
        
            // --- Analytics ---
            Route::get('analytics', [\App\Http\Controllers\CourseAdmin\CourseAdminAnalyticsController::class, 'index'])->name('analytics.index');
        });
    
    });
});



// == LECTURER AREA ==
use App\Http\Controllers\Lecturer\Auth\LecturerLoginController;
use App\Http\Controllers\Lecturer\LecturerDashboardController;
use App\Http\Controllers\Lecturer\LecturerCourseController;

Route::prefix('lecturer')->name('lecturer.')->group(function () {
    
    // Auth Routes
    Route::get('login', [LecturerLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LecturerLoginController::class, 'login'])->name('login.post');

    // Authenticated Routes
    Route::middleware('lecturer')->group(function () {
        Route::post('logout', [LecturerLoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [LecturerDashboardController::class, 'index'])->name('dashboard');
        Route::get('courses', [LecturerCourseController::class, 'index'])->name('courses.index');
        Route::get('courses/{course}', [LecturerCourseController::class, 'show'])->name('courses.show');
    });
});





// == STUDENT AREA ==
use App\Http\Controllers\Student\Auth\StudentLoginController;
use App\Http\Controllers\Student\Auth\StudentRegisterController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentCourseController;
use App\Http\Controllers\Student\StudentEnrolledCourseController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentCertificateController;



Route::prefix('student')->name('student.')->group(function () {
    

    // Registrasi
    Route::get('register', [StudentRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [StudentRegisterController::class, 'register']);

    // Login
    Route::get('login', [StudentLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [StudentLoginController::class, 'login']);


    // Rute untuk student yang sudah terotentikasi
    Route::middleware('student')->group(function () {
        Route::post('logout', [StudentLoginController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

        // Katalog Kursus
        Route::get('courses', [StudentCourseController::class, 'index'])->name('courses.index');
        Route::get('courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
        Route::post('enroll/{course}', [StudentCourseController::class, 'enroll'])->name('courses.enroll');

        // Kursus yang Diikuti & Halaman Belajar
        Route::get('my-courses', [StudentEnrolledCourseController::class, 'index'])->name('enrolled_course.index');
        Route::prefix('enrolled-course/{course}')->name('enrolled_course.')->group(function () {
            Route::get('/', [StudentEnrolledCourseController::class, 'show'])->name('show');
            Route::get('/googledrive/{googleDriveMaterial}', [StudentEnrolledCourseController::class, 'showGoogleDriveMaterial'])->name('googledrive');
            Route::get('/video/{video}', [StudentEnrolledCourseController::class, 'showVideo'])->name('video');
            Route::get('/quiz/{quiz}', [StudentEnrolledCourseController::class, 'showQuiz'])->name('quiz');
            Route::post('/quiz/{quiz}/submit', [StudentEnrolledCourseController::class, 'submitQuiz'])->name('quiz.submit');
            Route::post('/progress/{completable_type}/{completable_id}', [StudentEnrolledCourseController::class, 'markAsComplete'])->name('progress');
        });

        // Profil
        Route::get('profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');

        // === RUTE UNTUK SERTIFIKAT ===
        Route::get('my-certificates', [StudentCertificateController::class, 'index'])->name('certificates.index'); 
        Route::get('course/{course}/certificate', [StudentCertificateController::class, 'show'])->name('course.certificate');
        Route::get('course/{course}/certificate/download', [StudentCertificateController::class, 'download'])->name('course.certificate.download');
    });

});
