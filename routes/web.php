<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryMemberController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SystemadminController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MailandsmsController;
use App\Http\Controllers\TransportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web,systemadmin,teacher,student,parent', 'verified'])->name('dashboard');

Route::middleware('auth:web,systemadmin,teacher')->group(function () {
    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('systemadmin', SystemadminController::class);
    Route::resource('parents', ParentsController::class);
    Route::resource('classes', ClassesController::class);
    Route::resource('section', SectionController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('studentgroup', StudentGroupController::class);

    // Attendance Module
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/add', [AttendanceController::class, 'add'])->name('attendance.add');
    Route::post('attendance/save', [AttendanceController::class, 'save'])->name('attendance.save');
    Route::get('attendance/{id}', [AttendanceController::class, 'show'])->name('attendance.show');

    // Exam Module
    Route::resource('exam', ExamController::class);

    // Mark Module
    Route::get('mark', [MarkController::class, 'index'])->name('mark.index');
    Route::get('/mark/add', [MarkController::class, 'add'])->name('mark.add');
    Route::post('/mark/save', [MarkController::class, 'save'])->name('mark.save');

    // Conversation
    Route::get('/conversation/index', [ConversationController::class, 'index'])->name('conversation.index');
    Route::get('/conversation/sent', [ConversationController::class, 'sent'])->name('conversation.sent');
    Route::get('/conversation/draft', [ConversationController::class, 'draft'])->name('conversation.draft');
    Route::get('/conversation/trash', [ConversationController::class, 'trash'])->name('conversation.trash');
    Route::get('/conversation/create', [ConversationController::class, 'create'])->name('conversation.create');
    Route::post('/conversation/store', [ConversationController::class, 'store'])->name('conversation.store');
    Route::get('/conversation/view/{id}', [ConversationController::class, 'view'])->name('conversation.view');
    Route::delete('/conversation/delete/{id}', [ConversationController::class, 'delete'])->name('conversation.delete');
    
    // API for Select2/Dynamic Dropdowns
    Route::get('/api/users/{usertypeID}', [ConversationController::class, 'getUsers']);

    // Media
    Route::get('/media/index', [MediaController::class, 'index'])->name('media.index');
    Route::get('/media/view/{folderID}', [MediaController::class, 'viewFolder'])->name('media.view');
    Route::post('/media/add', [MediaController::class, 'add'])->name('media.add');
    Route::post('/media/create_folder', [MediaController::class, 'create_folder'])->name('media.create_folder');
    Route::delete('/media/delete/{id}', [MediaController::class, 'delete'])->name('media.delete');
    Route::delete('/media/deletef/{id}', [MediaController::class, 'deletef'])->name('media.deletef');

    // Mail/SMS
    Route::get('/mailandsms/index', [MailandsmsController::class, 'index'])->name('mailandsms.index');
    Route::get('/mailandsms/add', [MailandsmsController::class, 'add'])->name('mailandsms.add');
    Route::post('/mailandsms/store', [MailandsmsController::class, 'store'])->name('mailandsms.store');
    Route::get('/mailandsms/view/{id}', [MailandsmsController::class, 'view'])->name('mailandsms.view');

    // Library Module
    Route::get('library', LibraryController::class)->name('library.index');
    Route::resource('book', BookController::class);
    Route::resource('lmember', LibraryMemberController::class);
    Route::resource('issue', IssueController::class);
    Route::resource('transport', TransportController::class);
});

// Role-specific Dashboards
Route::middleware('auth:systemadmin')->group(function () {
    Route::get('/admin/dashboard', function () { return view('dashboard'); })->name('admin.dashboard');
});

Route::middleware('auth:teacher')->group(function () {
    Route::get('/teacher/dashboard', function () { return view('dashboard'); })->name('teacher.dashboard');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/student/dashboard', function () { return view('dashboard'); })->name('student.dashboard');
});

Route::middleware('auth:parent')->group(function () {
    Route::get('/parent/dashboard', function () { return view('dashboard'); })->name('parent.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
