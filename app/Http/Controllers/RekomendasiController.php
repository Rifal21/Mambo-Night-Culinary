<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use App\Models\KategoriMakanan;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRekomendasiRequest;
use App\Http\Requests\UpdateRekomendasiRequest;

class RekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('admin.rekomendasi.index', [
            'rekomendasi' => Rekomendasi::all(),
            'kategoriAll' => KategoriMakanan::all(),
            'tenant' => Tenant::all(),
            

        ]);
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
            'id_kategori' => 'required',
            'id_tenant' => 'required',
            'name' => 'required|max:255',
            'harga' => 'required',
            'gambar' => 'image|file',
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-rekomendasi'); 
        }

        Rekomendasi::create($validatedData);

        return redirect('/admin/rekomendasi')->with('success' , 'RekomendasiMenu baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekomendasi $rekomendasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekomendasi $rekomendasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_tenant' => 'required',
            'id_kategori' => 'required',
            'name' => 'required|max:255',
            'harga' => 'required',
            'gambar' => 'image|file',
        ];
    
        $validatedData = $request->validate($rules);
    
        $rekomendasi = Rekomendasi::findOrFail($id);
    
        // Check if a new image file is uploaded
        if ($request->file('gambar')) {
            // Delete old image if it exists
            if ($rekomendasi->gambar) {
                Storage::delete($rekomendasi->gambar);
            }
            // Store new image
            $validatedData['gambar'] = $request->file('gambar')->store('rekomendasi-menu');
        }
    
        // Update the category with validated data
        $rekomendasi->update($validatedData);
        // dd($kategoriMakanan);
    
        return redirect('/admin/rekomendasi')->with('success', 'Rekomendasi Menu berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);

        Storage::delete($rekomendasi->gambar);

    
        $rekomendasi->delete();

        //redirect to index
        return redirect('/admin/rekomendasi')->with(['success' => 'Rekomendasi Menu Berhasil Dihapus!']);
    }
}
