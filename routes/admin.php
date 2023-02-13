<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
use Laravel\Jetstream\Jetstream;
use App\Http\Livewire\Admin\Dashboard\Main as AdminMain;
use App\Http\Livewire\Admin\Posts\Post as AdminPost;
use App\Http\Livewire\Admin\Filters\Tag as AdminTag;
use App\Http\Livewire\Admin\Filters\Category as AdminCategory;
use App\Http\Livewire\Admin\Users\User as AdminUser;

// Route::get('admin/{id}', AdminMain::class)->name('admin.profile.info');
Route::prefix('admin')->name('admin.')->group(function(){
    Route::group(['middleware' => ['auth:web', 'verified', 'isadmin']], function () {
        route::get('/', AdminMain::class)->name('dashboard');
        route::get('/posts', AdminPost::class)->name('posts');
        route::get('/tags', AdminTag::class)->name('tags');
        route::get('/categories', AdminCategory::class)->name('categories');
        route::get('/users', AdminUser::class)->name('users');
    });

    $authMiddleware = config('jetstream.guard')
            ? 'auth:'.config('jetstream.guard')
            : 'auth';

    $authSessionMiddleware = config('jetstream.auth_session', false)
            ? config('jetstream.auth_session')
            : null;

    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
        // User & Profile...
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');

        Route::group(['middleware' => 'verified'], function () {
            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');

                Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');
            }
        });
    });
});