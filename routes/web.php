<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\galeriadmin;
use App\Http\Livewire\Admin\Fasilitashotel;
use App\Http\Livewire\Admin\Kamar;
use App\Http\Livewire\Admin\Update\Fasilitashotelupdate;
use App\Http\Livewire\Admin\Update\Galeriupdate;
use App\Http\Livewire\Admin\Update\Kamarupdate;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Page\Fasilitas;
use App\Http\Livewire\Page\Galeri;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Room;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', Login::class)->name('formlogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', Register::class)->name('formregister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', Home::class)->name('home');
Route::get('/room', Room::class)->name('room');
Route::get('/fasilitas', Fasilitas::class)->name('fasilitas');
Route::get('/galeri', Galeri::class)->name('galeri');


Route::get('admin', Dashboard::class)->name('admin');
Route::get('admin/kamar', Kamar::class)->name('admin.kamar');
Route::get('admin/kamar/update/{kamar_id}', Kamarupdate::class)->name('admin.kamarupdate');
Route::get('admin/galeri', galeriadmin::class)->name('admin.galeri');
Route::get('admin/galeri/update/{picture_id}', Galeriupdate::class)->name('admin.galeriupdate');
Route::get('admin/fasilitashotel', Fasilitashotel::class)->name('admin.fasilitashotel');
Route::get('admin/fasilitashotel/update/{fasilitas_id}', Fasilitashotelupdate::class)->name('admin.fasilitashotelupdate');




// Route::get('/', )



