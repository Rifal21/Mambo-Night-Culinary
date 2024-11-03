<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMenuRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuList = Menu::all();
        return view('admin.menu.menu', compact('menuList'));
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
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-menu'); 
        }

        Menu::create($validatedData);

        return redirect('/admin/menu')->with('success' , 'Menu baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
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
    
        $menu = Menu::findOrFail($id);
    
        // Check if a new image file is uploaded
        if ($request->file('gambar')) {
            // Delete old image if it exists
            if ($menu->gambar) {
                Storage::delete($menu->gambar);
            }
            // Store new image
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-menu');
        }
    
        // Update the category with validated data
        $menu->update($validatedData);
        // dd($kategoriMakanan);
    
        return redirect('/admin/menu')->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        Storage::delete($menu->gambar);

    
        $menu->delete();

        //redirect to index
        return redirect('/admin/menu')->with(['success' => 'Menu Berhasil Dihapus!']);
    }
}
