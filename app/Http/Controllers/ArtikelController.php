<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikel = Artikel::latest()->paginate(10);
        return view('admin.artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriArtikel::all();
        return view('admin.artikel.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:artikels',
            'kategori_artikel_id' => 'required',
            'body' => 'required',
            'author' => 'required',
            'published_at' => 'required',
            'image' => 'required|max:2048',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('gambar-artikel');
        }
        if ($request->hasFile('attachment')) {
            $validatedData['attachment'] = $request->file('attachment')->store('artikel-attachments');
        }

        Artikel::create($validatedData);

        return redirect('/admin/artikel')->with('success', 'Artikel baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artikel = Artikel::find($id);
        return view('admin.artikel.view', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        $kategori = KategoriArtikel::all();
        return view('admin.artikel.update', compact('artikel', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:artikels,slug,' . $artikel->id,
            'kategori_artikel_id' => 'required|exists:kategori_artikels,id',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|max:255',
            'published_at' => 'nullable|date',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        // Update file gambar jika diupload
        if ($request->hasFile('image')) {
            if ($artikel->image) {
                Storage::delete($artikel->image);
            }
            $validatedData['image'] = $request->file('image')->store('artikel-images');
        }

        // Update file attachment jika diupload
        if ($request->hasFile('attachment')) {
            if ($artikel->attachment) {
                Storage::delete($artikel->attachment);
            }
            $validatedData['attachment'] = $request->file('attachment')->store('artikel-attachments');
        }

        // Update data artikel
        $artikel->update($validatedData);

        return redirect('/admin/artikel')->with('success', 'Article updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->image) {
            Storage::delete($artikel->image);
        }
        if ($artikel->attachment) {
            Storage::delete($artikel->attachment);
        }
        $artikel->delete();
        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dihapus!');
    }
}
