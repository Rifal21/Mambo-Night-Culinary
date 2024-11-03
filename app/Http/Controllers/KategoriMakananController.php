<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\KategoriMakanan;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreKategoriMakananRequest;
use App\Http\Requests\UpdateKategoriMakananRequest;

class KategoriMakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriMakanan::paginate(6);
        $kategoriAll = KategoriMakanan::all();
        $menuList = Menu::paginate(6);
        $tenant = Tenant::all();
        return view('admin.kategori.index', compact('kategori' , 'menuList' , 'tenant' , 'kategoriAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'gambar' => 'image|file',
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('icon-kategori'); 
        }

        KategoriMakanan::create($validatedData);

        return redirect('/admin/menu')->with('success' , 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriMakanan $kategoriMakanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriMakanan $kategoriMakanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'gambar' => 'image|file',
        ];
    
        $validatedData = $request->validate($rules);
    
        $kategoriMakanan = KategoriMakanan::findOrFail($id);
    
        // Check if a new image file is uploaded
        if ($request->file('gambar')) {
            // Delete old image if it exists
            if ($kategoriMakanan->gambar) {
                Storage::delete($kategoriMakanan->gambar);
            }
            // Store new image
            $validatedData['gambar'] = $request->file('gambar')->store('icon-kategori');
        }
    
        // Update the category with validated data
        $kategoriMakanan->update($validatedData);
        // dd($kategoriMakanan);
    
        return redirect('/admin/menu')->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $kategori = KategoriMakanan::findOrFail($id);

        Storage::delete($kategori->gambar);

    
        $kategori->delete();

        //redirect to index
        return redirect('/admin/menu')->with(['success' => 'Kategori Berhasil Dihapus!']);
    }
}
