<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Dashboard\Main;

use App\Http\Livewire\Posts\Berita;

use App\Http\Livewire\Posts\Posts;
use App\Http\Livewire\Notif\NotifList;
use App\Http\Livewire\ProfilPt\AboutUs;
use App\Http\Livewire\ProfilPt\VisiMisi;

// use App\Http\Livewire\Search\SearchShow;

use App\Http\Livewire\Posts\Post as p;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', Main::class);
Route::get('/', Main::class)->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/posts', Posts::class)->name('posts');
    Route::get('/notif', NotifList::class)->name('notif');
});
Route::get('/posts/{id}', p::class);
Route::get('/cari/{data}', Berita::class)->name('cari');
Route::prefix('profilept')->name('profilept.')->group(function(){
    route::get('/tentang-kami', AboutUs::class)->name('aboutus');
    route::get('/visi-misi', VisiMisi::class)->name('vimi');
}); 


require __DIR__ . "/admin.php";
