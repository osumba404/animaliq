<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Admin\DonationCampaignController as AdminDonationCampaignController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\EventProceedingController as AdminEventProceedingController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ResearchProjectController as AdminResearchProjectController;
use App\Http\Controllers\Admin\ResearchReportController as AdminResearchReportController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuditLogController as AdminAuditLogController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamMemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/programs', [ProgramsController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [ProgramsController::class, 'show'])->name('programs.show');
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventsController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventsController::class, 'register'])->name('events.register')->middleware('auth');
Route::get('/research', [ResearchController::class, 'index'])->name('research.index');
Route::get('/research/{researchProject}', [ResearchController::class, 'show'])->name('research.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/donate', [DonationController::class, 'index'])->name('donations.index');
Route::get('/donate/campaign/{donationCampaign}', [DonationController::class, 'show'])->name('donations.show');
Route::post('/donate/campaign/{donationCampaign}/pay', [DonationController::class, 'initiatePayment'])->name('donations.initiate');
Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/{product}', [StoreController::class, 'show'])->name('store.show');

// Community portal (authenticated members)
Route::middleware(['auth'])->group(function () {
    Route::get('/community/dashboard', [CommunityController::class, 'dashboard'])->name('community.dashboard');
    Route::get('/community/profile', [CommunityController::class, 'profileEdit'])->name('community.profile');
    Route::put('/community/profile', [CommunityController::class, 'profileUpdate'])->name('community.profile.update');
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
});

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('departments/{department}/members', [AdminDepartmentController::class, 'addMember'])->name('departments.members.store');
    Route::delete('departments/{department}/members/{member}', [AdminDepartmentController::class, 'removeMember'])->name('departments.members.destroy');
    Route::get('departments-create-form', [AdminDepartmentController::class, 'formCreate'])->name('departments.create-form');
    Route::get('departments/{department}/edit-form', [AdminDepartmentController::class, 'formEdit'])->name('departments.edit-form');
    Route::resource('departments', AdminDepartmentController::class);
    Route::resource('programs', AdminProgramController::class);
    Route::resource('events', AdminEventController::class);
    Route::get('events/{event}/proceedings/create', [AdminEventProceedingController::class, 'create'])->name('events.proceedings.create');
    Route::post('events/{event}/proceedings', [AdminEventProceedingController::class, 'store'])->name('events.proceedings.store');
    Route::get('events/{event}/proceedings/edit', [AdminEventProceedingController::class, 'edit'])->name('events.proceedings.edit');
    Route::put('events/{event}/proceedings', [AdminEventProceedingController::class, 'update'])->name('events.proceedings.update');
    Route::delete('events/{event}/proceedings/images/{image}', [AdminEventProceedingController::class, 'destroyImage'])->name('events.proceedings.images.destroy')->where('image', '[0-9]+');
    Route::get('users-create-form', [AdminUserController::class, 'formCreate'])->name('users.create-form');
    Route::get('users/{user}/edit-form', [AdminUserController::class, 'formEdit'])->name('users.edit-form');
    Route::resource('users', AdminUserController::class);
    Route::get('settings', [AdminSiteSettingController::class, 'index'])->name('settings.index');
    Route::get('settings/sections/{section}', [AdminSiteSettingController::class, 'editSection'])->name('settings.sections');
    Route::put('settings/sections/{section}', [AdminSiteSettingController::class, 'updateSection'])->name('settings.sections.update');
    Route::get('settings/{setting}/edit', [AdminSiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings/{setting}', [AdminSiteSettingController::class, 'update'])->name('settings.update');
    Route::get('settings/slides', [AdminSiteSettingController::class, 'slides'])->name('settings.slides');
    Route::get('settings/slides/create-form', [AdminSiteSettingController::class, 'formSlidesCreate'])->name('settings.slides.create-form');
    Route::get('settings/slides/{slide}/edit-form', [AdminSiteSettingController::class, 'formSlidesEdit'])->name('settings.slides.edit-form');
    Route::get('settings/slides/create', [AdminSiteSettingController::class, 'slidesCreate'])->name('settings.slides.create');
    Route::post('settings/slides', [AdminSiteSettingController::class, 'slidesStore'])->name('settings.slides.store');
    Route::get('settings/slides/{slide}/edit', [AdminSiteSettingController::class, 'slidesEdit'])->name('settings.slides.edit');
    Route::put('settings/slides/{slide}', [AdminSiteSettingController::class, 'slidesUpdate'])->name('settings.slides.update');
    Route::delete('settings/slides/{slide}', [AdminSiteSettingController::class, 'slidesDestroy'])->name('settings.slides.destroy');
    Route::resource('research', AdminResearchProjectController::class)->parameters(['research' => 'researchProject']);
    Route::get('research/{researchProject}/reports/create', [AdminResearchReportController::class, 'create'])->name('research.reports.create');
    Route::post('research/{researchProject}/reports', [AdminResearchReportController::class, 'store'])->name('research.reports.store');
    Route::get('research/{researchProject}/reports/{report}/edit', [AdminResearchReportController::class, 'edit'])->name('research.reports.edit');
    Route::put('research/{researchProject}/reports/{report}', [AdminResearchReportController::class, 'update'])->name('research.reports.update');
    Route::delete('research/{researchProject}/reports/{report}', [AdminResearchReportController::class, 'destroy'])->name('research.reports.destroy');
    Route::post('posts/upload-image', [AdminPostController::class, 'uploadImage'])->name('posts.upload-image');
    Route::resource('posts', AdminPostController::class);
    Route::resource('donations', AdminDonationCampaignController::class)
        ->parameters(['donation' => 'donationCampaign'])
        ->names(['index' => 'donations.campaigns']);
    Route::resource('products', AdminProductController::class);
    Route::get('team-create-form', [AdminTeamMemberController::class, 'formCreate'])->name('team.create-form');
    Route::get('team/{team}/edit-form', [AdminTeamMemberController::class, 'formEdit'])->name('team.edit-form');
    Route::resource('team', AdminTeamMemberController::class);
    Route::get('audit', [AdminAuditLogController::class, 'index'])->name('audit.index');
});

Route::get('/fix-storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    
    $output = "Correct Target: $target <br>Correct Link: $link <br><hr>";
    
    if (file_exists($link) || is_link($link)) {
        is_link($link) ? unlink($link) : false; // Remove if broken
    }
    
    try {
        symlink($target, $link);
        $output .= "<b style='color:green'>SUCCESS: Laravel's native storage link has been perfectly recreated.</b>";
    } catch (\Exception $e) {
        $output .= "<b style='color:red'>FAILED:</b> " . $e->getMessage();
    }
    
    return $output . "<br><a href='/'>Go Home and verify images</a>";
});
