<?php

namespace App\Http\Controllers;

use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class KategoriArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriArtikel::all();

        return view('admin.kategoriArtikel.index', compact('kategori'));
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
            'name' => 'required'
        ]);

        KategoriArtikel::create($validatedData);

        return redirect('/admin/kategori-artikel')->with('success', 'Kategori Artikel baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriArtikel $kategoriArtikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriArtikel $kategoriArtikel)
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
        ];

        $validatedData = $request->validate($rules);

        $kategoriMakanan = KategoriArtikel::findOrFail($id);

        $kategoriMakanan->update($validatedData);


        return redirect('/admin/kategori-artikel')->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = KategoriArtikel::findOrFail($id);



        $kategori->delete();

        //redirect to index
        return redirect('/admin/kategori-artikel')->with(['success' => 'Kategori Berhasil Dihapus!']);
    }
}
