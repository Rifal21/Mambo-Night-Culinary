<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Banner;
use App\Models\Tenant;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use App\Models\KategoriMakanan;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'title' => 'List Menu Makanan',
            'kategoriAll' => KategoriMakanan::all(),
            'menu' => Menu::paginate(8),
            'tenant' => Tenant::paginate(8),
            'banner' => Banner::all(),
            'rekomendasi' => Menu::latest()->paginate(8),
        ]);
    }
}
