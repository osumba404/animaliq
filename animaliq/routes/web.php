<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdvocacyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnershipsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Admin\DonationCampaignController as AdminDonationCampaignController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ResearchProjectController as AdminResearchProjectController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuditLogController as AdminAuditLogController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/programs', [ProgramsController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [ProgramsController::class, 'show'])->name('programs.show');
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventsController::class, 'show'])->name('events.show');
Route::get('/research', [ResearchController::class, 'index'])->name('research.index');
Route::get('/research/{researchProject}', [ResearchController::class, 'show'])->name('research.show');
Route::get('/advocacy', [AdvocacyController::class, 'index'])->name('advocacy.index');
Route::get('/advocacy/{campaign}', [AdvocacyController::class, 'show'])->name('advocacy.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/partnerships', [PartnershipsController::class, 'index'])->name('partnerships.index');
Route::get('/donate', [DonationController::class, 'index'])->name('donations.index');
Route::get('/donate/campaign/{donationCampaign}', [DonationController::class, 'show'])->name('donations.show');
Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/{product}', [StoreController::class, 'show'])->name('store.show');

// Community portal (authenticated members)
Route::middleware(['auth'])->group(function () {
    Route::get('/community/dashboard', [CommunityController::class, 'dashboard'])->name('community.dashboard');
});

// Auth stub routes (so welcome and layout don't break; install Laravel Breeze for full auth)
Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');
Route::get('/register', function () {
    return redirect()->route('home');
})->name('register');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('departments', AdminDepartmentController::class);
    Route::resource('programs', AdminProgramController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('users', AdminUserController::class);
    Route::get('settings', [AdminSiteSettingController::class, 'index'])->name('settings.index');
    Route::get('settings/slides', [AdminSiteSettingController::class, 'slides'])->name('settings.slides');
    Route::get('settings/{setting}/edit', [AdminSiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings/{setting}', [AdminSiteSettingController::class, 'update'])->name('settings.update');
    Route::resource('research', AdminResearchProjectController::class)->parameters(['research' => 'researchProject']);
    Route::resource('campaigns', AdminCampaignController::class);
    Route::resource('posts', AdminPostController::class);
    Route::resource('donations', AdminDonationCampaignController::class)
        ->parameters(['donation' => 'donationCampaign'])
        ->names(['index' => 'donations.campaigns']);
    Route::resource('products', AdminProductController::class);
    Route::get('audit', [AdminAuditLogController::class, 'index'])->name('audit.index');
});
