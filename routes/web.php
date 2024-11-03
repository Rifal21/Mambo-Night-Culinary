<?php

use App\Models\Menu;
use App\Models\Banner;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\KategoriMakanan;
use App\Models\PendaftaranTenant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\KategoriMakananController;
use App\Http\Controllers\PendaftaranTenantController;
use App\Http\Controllers\PendaftaranTenantAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout'])->middleware('admin');

Route::resource('/admin/dashboard', BannerController::class)->middleware('admin');
Route::resource('/admin/tenant' , TenantController::class)->middleware('admin');
Route::resource('/admin/menu', KategoriMakananController::class)->middleware('admin');
Route::resource('/admin/menu-list', MenuController::class)->middleware('admin');
Route::resource('/admin/rekomendasi', RekomendasiController::class)->middleware('admin');

Route::get('/menu-list' , function(){
    return view('menuHome', [
        'title' => 'List Menu Makanan',
        'kategoriAll' => KategoriMakanan::all()
    ]);
});

Route::get('/menu-by/{kategori_id}', function ($kategory_id) {
    // Find the category by ID
    $kategori = KategoriMakanan::findOrFail($kategory_id);

    // Fetch all menus associated with this category ID
    $menus = Menu::where('id_kategori', $kategori->id)->paginate(6);

    return view('orderMenu', [
        'title' => 'List Menu Makanan',
        'kategoriAll' => KategoriMakanan::all(),
        'kategori' => $kategori,
        'menus' => $menus
    ]);
});

Route::get('/all-menu', function () {
    // Initialize the query builder for the Menu model
    $menuQuery = Menu::latest();
    $kategoriAll = KategoriMakanan::all();

    // Apply the search filter if provided
    if (request('search')) {
        $menuQuery->where('name', 'like', '%' . request('search') . '%');
    }

    // Paginate the results (9 items per page)
    $menu = $menuQuery->paginate(9);

    return view('allMenu', [
        'title' => 'List Menu Makanan',
        'kategoriAll' => $kategoriAll,
        'menu' => $menu,
    ]);
});
Route::get('/all-tenant', function () {
    // Initialize the query builder for the Menu model
    $tenantQuery = Tenant::latest();
    $kategoriAll = KategoriMakanan::all();

    // Apply the search filter if provided
    if (request('search')) {
        $tenantQuery->where('name', 'like', '%' . request('search') . '%');
    }

    // Paginate the results (9 items per page)
    $tenant = $tenantQuery->paginate(9);

    return view('allTenant', [
        'title' => 'List Menu Makanan',
        'kategoriAll' => $kategoriAll,
        'tenant' => $tenant,
    ]);
});

Route::resource('/pendaftaran', PendaftaranTenantController::class);
Route::get('/admin/pendaftaran', [PendaftaranTenantAdminController::class, 'index'])->middleware('admin');
Route::get('/admin/pendaftaran/{id}/verifikasi', [PendaftaranTenantAdminController::class, 'verifikasi'])->name('pendaftaran.verifikasi')->middleware('admin');
Route::get('/admin/pendaftaran/{id}/tolak', [PendaftaranTenantAdminController::class, 'tolak'])->name('pendaftaran.tolak')->middleware('admin');
Route::get('/pendaftaran/download/{id}', [PendaftaranTenantAdminController::class, 'downloadPdf'])->name('pendaftaran.download')->middleware('admin');
