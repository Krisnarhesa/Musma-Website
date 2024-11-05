<?php
define('TIMEZONE', 'Asia/Makassar');
date_default_timezone_set(TIMEZONE);

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CalonController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MainController;
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

// Route::auth();
Route::get('/', [MainController::class, 'index'])->name('home');

Route::get("/storage-link", function () {
    $targetFolder = storage_path("app/public");
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

// if (date("Y-m-d") < '2024-01-08') {
//     Route::get('register', [RegisterController::class, 'index'])->name('register');
//     Route::post('register', [RegisterController::class, 'create'])->name('register.create');
// }

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'create'])->name('register.create');

Route::post('register/fetch', [RegisterController::class, 'fetchByNIM'])->name('autocomplete.fetch');
Route::get('login', [LoginController::class, 'index'])->name('auth');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('calon/fetch', [CalonController::class, 'fetch'])->name('calon.fetch');
Route::post('visi-misi', [MainController::class, 'misi'])->name('visimisi');
// Route::get('rekapitulasi', [MainController::class, 'rekap'])->name('rekap');
// Route::view('comingsoon','comingsoon')->name('comingsoon');

Route::middleware(['auth'])->group(function () {
    Route::get('chart', [MainController::class, 'chart'])->name('chart');
    Route::post('vote', [MainController::class, 'vote'])->name('vote');

    Route::get('logout', [MainController::class, 'logout']);
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware(['auth', 'role:admin|sekre'])->group(function () {
    Route::get("admin", 'DashboardController@index');

    Route::get("admin/role/", 'RoleController@index');
    Route::put("admin/role/update/{role_model:model_id}", 'RoleController@update');

    Route::get("admin/calon", 'CalonController@index');
    Route::get("admin/calon/create", 'CalonController@create');
    Route::post("admin/calon/store", 'CalonController@store');
    Route::get("admin/calon/edit/{calon:id}", 'CalonController@edit');
    Route::put("admin/calon/update/{calon:id}", 'CalonController@update');
    Route::delete("admin/calon/delete/{calon:id}", 'CalonController@destroy');

    Route::get("admin/mahasiswa", 'MahasiswaController@index');
    Route::get("admin/mahasiswa/data", 'MahasiswaController@data');
    Route::put("admin/mahasiswa/verif/{mahasiswa:id}", 'MahasiswaController@verif');
    Route::delete("admin/mahasiswa/delete/{mahasiswa:id}", 'MahasiswaController@destroy');

    Route::get("admin/absen", [AbsenController::class, 'index']);
    Route::delete("admin/absen/reset/{absen:id}", [AbsenController::class, 'destroy']);
    // Route::get("admin/absen/edit/{absen:id}", [AbsenController::class, 'edit']);
    // Route::put("admin/absen/update/{absen:id}", [AbsenController::class, 'update']);
    // Route::delete("admin/absen/delete/{absen:id}", [AbsenController::class, 'destroy']);
});
