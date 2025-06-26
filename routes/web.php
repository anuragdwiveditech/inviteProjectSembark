<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UserController;

Route::get('/', function () { return redirect('/dashboard'); });

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ShortUrlController::class, 'index'])->name('dashboard');
    Route::get('/short-urls', [ShortUrlController::class, 'index'])->name('short-urls.index');
    Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');
});

Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::get('invite/admin', [UserController::class,'showInviteAdmin'])->name('invite.admin');
    Route::post('invite/admin', [UserController::class,'inviteAdmin'])->name('admin.invite');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('invite/user', [UserController::class,'showInviteUser'])->name('invite.user');
    Route::post('invite/user', [UserController::class,'inviteUser'])->name('user.invite');
});

Route::get('/s/{shortCode}', [ShortUrlController::class, 'resolve'])->name('short-urls.resolve');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});
// ✅ Add this line to enable login/register/logout routes
require __DIR__.'/auth.php';
