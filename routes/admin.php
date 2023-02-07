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
use App\Http\Livewire\Admin\Dashboard\Main as AdminMain;
use App\Http\Livewire\Admin\Posts\Post as AdminPost;
use App\Http\Livewire\Admin\Posts\Tag as AdminTag;
use App\Http\Livewire\Admin\Posts\Category as AdminCategory;
use App\Http\Livewire\Admin\Users\User as AdminUser;

// Route::get('admin/{id}', AdminMain::class)->name('admin.profile.info');
Route::prefix('admin')->name('admin.')->group(function(){
    route::get('/', AdminMain::class)->name('dashboard');
    route::get('/posts', AdminPost::class)->name('posts');
    route::get('/tags', AdminTag::class)->name('tags');
    route::get('/categories', AdminCategory::class)->name('categories');
    route::get('/users', AdminUser::class)->name('users');
});